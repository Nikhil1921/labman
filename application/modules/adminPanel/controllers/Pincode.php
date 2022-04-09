<?php defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pincode extends Admin_controller  {

    public function __construct()
	{
		parent::__construct();
        $this->states = $this->main->getAll('states', 'id, s_name', ['is_deleted' => 0]);
	}

	private $table = 'pincodes';
	protected $redirect = 'pincode';
	protected $title = 'Pincode';
	protected $name = 'pincode';
	
	public function index()
	{
		$data['title'] = $this->title;
        $data['name'] = $this->name;
        $data['url'] = $this->redirect;
        $data['operation'] = "List";
        $data['datatable'] = "$this->redirect/get";
		
		return $this->template->load('template', "$this->redirect/home", $data);
	}

    public function get()
    {
        check_ajax();
        $this->load->model('pincode_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $this->input->get('start') + 1;
        $data = [];

        foreach($fetch_data as $row)
        {
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->pincode;
            $sub_array[] = $row->del_charge;
            
            $action = '<div class="btn-group" role="group"><button class="btn btn-success dropdown-toggle" id="btnGroupVerticalDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon-settings"></span></button><div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start">';
            
            $action .= anchor($this->redirect."/update/".e_id($row->id), '<i class="fa fa-edit"></i> Edit</a>', 'class="dropdown-item"');
        
            $action .= form_open($this->redirect.'/delete', 'id="'.e_id($row->id).'"', ['id' => e_id($row->id)]).
                '<a class="dropdown-item" onclick="script.delete('.e_id($row->id).'); return false;" href=""><i class="fa fa-trash"></i> Delete</a>'.
                form_close();

            $action .= '</div></div>';
            $sub_array[] = $action;

            $data[] = $sub_array;  
            $sr++;
        }

        $output = [
            "draw"              => intval($this->input->get('draw')),  
            "recordsTotal"      => $this->data->count(),
            "recordsFiltered"   => $this->data->get_filtered_data(),
            "data"              => $data
        ];
        
        die(json_encode($output));
    }

    public function add()
	{
        $this->form_validation->set_rules($this->validate);

        $data['title'] = $this->title;
        $data['name'] = $this->name;
        $data['operation'] = "Add";
        $data['url'] = $this->redirect;

        if ($this->form_validation->run() == FALSE)
            return $this->template->load('template', "$this->redirect/form", $data);
        else{
            $post = [
                's_id'           => d_id($this->input->post('s_id')),
                'pincode'        => $this->input->post('pincode'),
                'del_charge'     => $this->input->post('del_charge')
            ];

            $id = $this->main->add($post, $this->table);

            flashMsg($id, "$this->title added.", "$this->title not added. Try again.", $this->redirect);
            
        }
	}

	public function update($id)
	{
        $this->form_validation->set_rules($this->validate);

        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = $this->title;
            $data['name'] = $this->name;
            $data['operation'] = "Update";
            $data['url'] = $this->redirect;
            $data['data'] = $this->main->get($this->table, 'pincode, del_charge, s_id', ['id' => d_id($id)]);
            
            return $this->template->load('template', "$this->redirect/form", $data);
        }else{
            $post = [
                's_id'           => d_id($this->input->post('s_id')),
                'pincode'        => $this->input->post('pincode'),
                'del_charge'     => $this->input->post('del_charge')
            ];
            
            $id = $this->main->update(['id' => d_id($id)], $post, $this->table);

            flashMsg($id, "$this->title updated.", "$this->title not updated. Try again.", $this->redirect);
        }
	}

	public function bulk()
	{
        $this->form_validation->set_rules([
            [
                'field' => 's_id',
                'label' => 'State',
                'rules' => 'required|integer|trim',
                'errors' => [
                    'required' => "%s is required",
                    'integer' => "Only numbers are allowed.",
                ],
            ]
        ]);

        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = $this->title;
            $data['name'] = $this->name;
            $data['operation'] = "Upload";
            $data['url'] = $this->redirect;
            
            return $this->template->load('template', "$this->redirect/bulk", $data);
        }else{
            if(empty($_FILES['file']['name'])) return flashMsg(0, "", "Select file to upload", "$this->redirect/bulk");
            set_time_limit(0);
            $path = $_FILES["file"]["tmp_name"];
            $object = \PhpOffice\PhpSpreadsheet\IOFactory::load($path);
            foreach($object->getWorksheetIterator() as $worksheet)
            {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for($row=2; $row <= $highestRow; $row++)
                {
                    $pin = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $del = $worksheet->getCellByColumnAndRow(2, $row)->getValue();

                    if (!$this->main->check($this->table, ['pincode' => $pin, 'is_deleted' => 0], 'id')) {
                        $post[] = [
                            's_id'       => d_id($this->input->post('s_id')),
                            'pincode'    => $pin,
                            'del_charge' => $del
                        ];
                    }
                }
            }

            $id = isset($post) ? $this->main->bulk_upload($post, $this->table) : 0;

            flashMsg($id, "$this->title uploaded.", "$this->title not uploaded. Try again.", $this->redirect);
        }
	}

	public function delete()
    {
        $this->form_validation->set_rules('id', 'id', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE)
            flashMsg(0, "", "Some required fields are missing.", $this->redirect);
        else{
            $id = $this->main->update(['id' => d_id($this->input->post('id'))], ['is_deleted' => 1], $this->table);
            flashMsg($id, "$this->title deleted.", "$this->title not deleted.", $this->redirect);
        }
    }

    public function pincode_check($pin)
    {
        $check = $this->uri->segment(4) ? d_id($this->uri->segment(4)) : 0;

        $where = ['pincode' => $pin, 'id != ' => $check, 'is_deleted' => 0];
        
        if ($this->main->check($this->table, $where, 'id'))
        {
            $this->form_validation->set_message('pincode_check', 'The %s is already in use');
            return FALSE;
        } else
            return TRUE;
    }

    protected $validate = [
        [
            'field' => 'pincode',
            'label' => 'Pincode',
            'rules' => 'required|exact_length[6]|integer|trim|callback_pincode_check',
            'errors' => [
                'required' => "%s is required",
                'exact_length' => "%s is invalid.",
                'integer' => "Only numbers are allowed.",
            ],
        ],
        [
            'field' => 'del_charge',
            'label' => 'Category slug',
            'rules' => 'required|max_length[3]|integer|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 3 chars allowed.",
                'integer' => "Only numbers are allowed.",
            ],
        ],
        [
            'field' => 's_id',
            'label' => 'State',
            'rules' => 'required|integer|trim',
            'errors' => [
                'required' => "%s is required",
                'integer' => "Only numbers are allowed.",
            ],
        ]
    ];
}