<?php namespace App\Controllers;
use App\Models\BlogModel;
class Blog extends BaseController
{
	public function index(){
       // return view ('pages/home');
    }
    
    function post($slug){
       
        $model = new BlogModel();

        $data['post']=$model->getPosts($slug);

        //echo 'this is another page '.$page;

        echo view('templates/header', $data);
        echo view('blog/post');
        echo view('templates/footer');
        
    }
    function created(){
       // helper('form');
        $model = new BlogModel();
        echo view('templates/header');
             echo view('blog/created');
             echo view('templates/footer');
        $data = [
            'title'=> $this->request->getPost('title'),
            'body'=> $this->request->getPost('body'),
            //'slug' => url_title($this->request->getPost('title')),
        
        ];
        $model->save($data);
        return redirect()->to('/uframe/public/blog/view');
    }
  
    function create(){
        helper('form');
       // helper(['url','form']);
        $model = new BlogModel();

        if(! $this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'body' => 'required'
        ])){
             echo view('templates/header');
             echo view('blog/create');
             echo view('templates/footer');
        }else{
            $model->save(
                [
                    'title'=> $this->request->getVar('title'),
                    'body'=> $this->request->getVar('body'),
                    'slug' => url_title($this->request->getVar('title')),
                ]
                );
                $session = \Config\Services::session();
                $session->setFlashdata('success', 'Post Created Successfully');
                //$session->$this->session->set_flashdata('succcess', 'Post Created Successfully');
                
          return redirect()->to('/uframe/public');
     
                //return redirect()->to('http://localhost:8080/uframe/public/blog/create');
        }
    }

    function view(){
        $model = new BlogModel();
        $data['posts'] = $model->findAll();
        //$data['post']=$model->getPosts($slug);
        return view ('blog/view', $data);
    }
    
    function edited($id){
       
        $model = new BlogModel();
        $data['posts'] = $model->find($id);
        return view('blog/edited',$data);
    }
    public function update($id){
        $model = new BlogModel();
       // $model->find($id);
        $data = [
            'title'=> $this->request->getPost('title'),
            'body'=> $this->request->getPost('body'),
            
        ];
        $model->update($id, $data);
        $session = \Config\Services::session();
        $session->setFlashdata('success', 'Post Updated Successfully');

        return redirect()->to('/uframe/public');

        
    }
    public function delete($id){
        $model = new BlogModel();
        $model->delete($id);
        $session = \Config\Services::session();
        $session->setFlashdata('success', 'Post Deleted Successfully');
        return redirect()->to('/uframe/public');


    }

    // public function update() {
    //     if ($this->request->getMethod() == 'post') {
    //         $id = $this->request->getVar('id', FILTER_SANITIZE_NUMBER_INT);
    //         $project_data = [
    //             'title'=> $this->request->getVar('title', FILTER_SANITIZE_STRING),
    //             'body'=> $this->request->getVar('body', FILTER_SANITIZE_STRING),
    //         ];		
    //         if ($this->project_model->update($id, $project_data) === true) {
    //             return redirect()->to(base_url('projects'));	
    //         } else {
    //             $data = [
    //                 'page_title' => 'Single Project',
    //                 'errors' => $this->model->errors(),
    //                 'project' => $this->model->find($id),
    //             ];	
    //             return view('edit_project', $data);
    //         }
    //     }
    // }

    // public function delete($id = null){
    //     $model = new BlogModel();
    //     //$data['post']=$model->getPosts($id);

    //     //$model->where('id', $id)->delete();
    //     //$this->request->getVar
      
    //    // $model->where('id', $id)->delete($id);
    //     //$model->delete($id);
    //     //$this->db->where('id',$id);
    //     $model->delete(42);

    // //     $id=$this->input->get('id');
    // //     $response=$this->model->delete($id);
    // //     if($response==true){
    // //       echo "Data deleted successfully !";
    // //   }
    // //     else{
    // //       echo "Error !";
    // //     }

    //     $session = \Config\Services::session();
    //     $session->setFlashdata('success', 'Post Deleted Successfully');

    //     //return redirect()->back()->with('Status', 'post deleted');
    //     return redirect()->to('/uframe/public');
    // }

	//--------------------------------------------------------------------

}