<?php

namespace App\Controller;

use App\Controller\AppController;

class MemosController extends AppController{

    /**
     * 
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash');
    }
    
    /**
     * 
     */
    public function index()
    {   
        if($this->Authentication->getIdentity() == null){
            $logged=false;
        }else{
            $logged=true;
        }
            
        if($logged){
            $memos = $this->Paginator->paginate($this->Memos->find());
            $this->set(compact('memos'));
        }else{
            $memos = $this->Paginator->paginate($this->Memos->findByPublic(true));
            $this->set(compact('memos'));
        }     
        
        $this->set('logged', $logged);
    }
    
    /**
     * 
     */
    public function view($slug = null)
    {
        $memo = $this->Memos->findBySlug($slug)->firstOrFail();
        $this->set(compact('memo'));
    }

    /**
     * 
     */
    public function add()
    {
        $memo = $this->Memos->newEmptyEntity();
        
        if($this->request->is('post')){
            
            $memo = $this->Memos->patchEntity($memo, $this->request->getData());
            $memo->user_id = $this->request->getAttribute('identity')->getIdentifier();

            if($this->Memos->save($memo)){
                
                $this->Flash->success(__('Your memo has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Unable to add your memo.'));
        }
        $this->set('memo', $memo);
    }

    /**
     * 
     */
    public function edit($slug)
    {
        $memo = $this->Memos
            ->findBySlug($slug)
            ->firstOrFail();

        if($this->request->is(['post', 'put'])){
            
            $this->Memos->patchEntity($memo, $this->request->getData());
            
            if($this->Memos->save($memo)){
            
                $this->Flash->success(__('Your memo has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your memo.'));
        }

        $this->set('memo', $memo);

    }
    
    /**
     * 
     */
    public function delete($slug)
    {
        $this->request->allowMethod(['post', 'delete']);
        
        $memo = $this->Memos->findBySlug($slug)->firstOrFail();
        
        if ($this->Memos->delete($memo)) {
            
            $this->Flash->success(__('The {0} memo has been deleted.', $memo->title));
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Memos',
                'action' => 'index',
            ]);

            return $this->redirect($redirect);
        }
    }

}