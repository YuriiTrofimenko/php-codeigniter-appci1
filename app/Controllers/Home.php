<?php namespace App\Controllers;

class Home extends BaseController
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = model('App\Models\ItemModel');
    }

    public function index()
	{
		// return view('welcome_message');
        return "Hello CodeIgniter 4!";
	}

    public function page1()
    {
        // return view('page1');
        $data['title']='Page1';
        $data['text']='This text was send from Home controller';
        $data['countries'] = array('Argentina','Belgium','Canada','Great Britain');
        return view('page1', $data);
    }

    public function items()
    {
        $data['title']='Items';
        $data['items']=$this->userModel->findAll();
        return view('items', $data);
    }

    public function getItemDescription()
    {
        $send = $this->input->post('send');
        if(!$send)
            return view('get_item_description');
        else
        {
            /* $id = $this->input->post('itemid');
            $item=$this->home_model->getItemById($id);
            $data['item']=$item;
            $data['title']='Description Of Items '.$id;
            $this->load->view('item _ info',$data); */
        }
    }

	//--------------------------------------------------------------------

}
