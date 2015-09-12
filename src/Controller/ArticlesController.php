<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 */
class ArticlesController extends AppController
{
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $settings = [
            'Articles' => [
            'limit' => 5,
            'maxLimit' => 6
            ]
        ];
        $this->set('articles', $this->paginate($this->Articles, $settings));
        $this->set('_serialize', ['articles']);
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {

        $article = $this->Articles->get($id, [
            'contain' => []
        ]);
        $this->set('article', $article);
        $this->set('_serialize', ['article']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */

public function add()
{
    $article = $this->Articles->newEntity();
    if ($this->request->is('post')) {
        $article = $this->Articles->patchEntity($article, $this->request->data);
        // Added this line
        $article->username = $this->Auth->user('username');
        // You could also do the following
        $newData = ['author' => $this->Auth->user('username')];
        $article = $this->Articles->patchEntity($article, $newData);
        if ($this->Articles->save($article)) {
            $this->Flash->success(__('Your article has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to add your article.'));
    }
    $this->set('article', $article);
}
/**
 * uploads files to the server
 * @params:
 *      $folder     = the folder to upload the files e.g. 'img/files'
 *      $formdata   = the array containing the form files
 *      $itemId     = id of the item (optional) will create a new sub folder
 * @return:
 *      will return an array with the success of each file upload
 */
public function uploadFiles($folder, $formdata, $itemId = null) {
    // setup dir names absolute and relative
    $folder_url = WWW_ROOT.$folder;
    $rel_url = $folder;
    
    // create the folder if it does not exist
    if(!is_dir($folder_url)) {
        mkdir($folder_url);
    }
        
    // if itemId is set create an item folder
    if($itemId) {
        // set new absolute folder
        $folder_url = WWW_ROOT.$folder.'/'.$itemId; 
        // set new relative folder
        $rel_url = $folder.'/'.$itemId;
        // create directory
        if(!is_dir($folder_url)) {
            mkdir($folder_url);
        }
    }
    
    // list of permitted file types, this is only images but documents can be added
    $permitted = array('image/gif','image/jpeg','image/pjpeg','image/png');
    
    // loop through and deal with the files
    foreach($formdata as $file) {
        // replace spaces with underscores
        $filename = str_replace(' ', '_', $file['name']);
        // assume filetype is false
        $typeOK = false;
        // check filetype is ok
        foreach($permitted as $type) {
            if($type == $file['type']) {
                $typeOK = true;
                break;
            }
        }
        
        // if file type ok upload the file
        if($typeOK) {
            // switch based on error code
            switch($file['error']) {
                case 0:
                    // check filename already exists
                    if(!file_exists($folder_url.'/'.$filename)) {
                        // create full filename
                        $full_url = $folder_url.'/'.$filename;
                        $url = $rel_url.'/'.$filename;
                        // upload the file
                        $success = move_uploaded_file($file['tmp_name'], $url);
                    } else {
                        // create unique filename and upload file
                        ini_set('date.timezone', 'Europe/London');
                        $now = date('Y-m-d-His');
                        $full_url = $folder_url.'/'.$now.$filename;
                        $url = $rel_url.'/'.$now.$filename;
                        $success = move_uploaded_file($file['tmp_name'], $url);
                    }
                    // if upload was successful
                    if($success) {
                        // save the url of the file
                        $result['urls'][] = $url;
                    } else {
                        $result['errors'][] = "Error uploaded $filename. Please try again.";
                    }
                    break;
                case 3:
                    // an error occured
                    $result['errors'][] = "Error uploading $filename. Please try again.";
                    break;
                default:
                    // an error occured
                    $result['errors'][] = "System error uploading $filename. Contact webmaster.";
                    break;
            }
        } elseif($file['error'] == 4) {
            // no file was selected for upload
            $result['nofiles'][] = "No file Selected";
        } else {
            // unacceptable file type
            $result['errors'][] = "$filename cannot be uploaded. Acceptable file types: gif, jpg, png.";
        }
    }
return $result;
}

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->data);
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The article could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('article'));
        $this->set('_serialize', ['article']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
        if (in_array($this->request->action, ['add', 'view'])) {
            return true;
        }

        if (in_array($this->request->action, ['edit', 'delete'])) {
            $articleId = (int)$this->request->params['pass'][0];
            if ($this->Articles->isOwnedBy($articleId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }
}
