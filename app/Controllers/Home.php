<?php namespace App\Controllers;

use \YaLinqo\Enumerable;

class Home extends BaseController
{
    private $itemModel;
    private $imageModel;

    public function __construct()
    {
        $this->itemModel = model('App\Models\ItemModel');
        $this->imageModel = model('App\Models\ImageModel');
    }

    public function index()
    {
        // return view('welcome_message');
        return "Hello CodeIgniter 4!";
    }

    public function page1()
    {
        // return view('page1');
        $data['title'] = 'Page1';
        $data['text'] = 'This text was send from Home controller';
        $data['countries'] = array('Argentina', 'Belgium', 'Canada', 'Great Britain');
        return view('page1', $data);
    }

    public function items()
    {
        $data['title'] = 'Items';
        $data['items'] = $this->itemModel->findAll();
        return view('items', $data);
    }

    public function getItemDescription()
    {
        $send = $this->request->getPost('send');
        if (!$send)
            return view('get_item_description');
        else {
            // получить из тела запроса значение параметра itemid
            $id = $this->request->getPost('itemid');
            // стандартным методом получить из БД все данные пункта, выбранного по ИД = $id
            $item = $this->itemModel->find($id);
            // собрать данные в массив
            $data['item'] = $item;
            $data['title'] = 'Description Of Items ' . $id;
            // отрисовать представление item_info,
            // передав ему данные $data,
            // и вернуть готовую веб-страницу клиенту
            return view('item_description', $data);
        }
    }

    public function getItemDescription2()
    {
        $send = $this->request->getPost('send');
        if (!$send) {
            $data['items'] =
                Enumerable::from($this->itemModel->findAll())
                    ->aggregate(function ($a, $v, $k) {
                        $a[$v['id']] = $v['name'];
                        return $a;
                    }, []);
            return view('get_item_description2', $data);
        } else {
            // получить из тела запроса значение параметра itemid
            $id = $this->request->getPost('itemid');
            // стандартным методом получить из БД все данные пункта, выбранного по ИД = $id
            $item = $this->itemModel->find($id);
            // собрать данные в массив
            $data['item'] = $item;
            $data['title'] = 'Description Of Items ' . $id;
            // отрисовать представление item_info,
            // передав ему данные $data,
            // и вернуть готовую веб-страницу клиенту
            return view('item_description', $data);
        }
    }

    public function selectImages()
    {
        $send = $this->request->getPost('send');
        if (!$send)
            return view('form_upload');
        else {
            $file = $this->request->getFile('image');
            $isValid = $this->validate([
                'image' => [
                    'uploaded[image]',
                    'max_size[image,10000]',
                    'max_dims[image,10000,10000]',
                    'ext_in[image,png,jpg,jpeg,gif]'
                ]
            ]);
            if (!$isValid) {
                $data['error'] = '';
                foreach ($this->validator->getErrors() as $error) {
                    $data['error'] .= "<br>$error";
                }
                return view('form_upload', $data);
            } else {
                $path = '/upload/images/';
                $fileName = uniqid() . '_' . $file->getName();
                $data = [
                    'item_id' => 1,
                    'path' => $path . $fileName
                ];
                $file->move('.' . $path, $fileName);
                $imageId = null;
                try{
                    $imageId = $this->imageModel->insert($data);
                } catch (\Exception $ex) {
                    return view('form_upload', $ex->getMessage());
                }
                $info = [];
                if ($imageId != null) {
                    $info['result'] =
                        'Successfully Inserted New Image With Id='.$imageId;
                } else {
                    $info['error'] = "$imageId is null";
                }
                return view('form_upload', $info);
            }
        }
    }
}
