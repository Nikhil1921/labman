<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Details extends Admin_controller  {

	private $table = 'lab_partners';
	protected $redirect = 'details';

	public function index()
	{
        $this->form_validation->set_rules('details', 'Lab details', 'required', ['required' => "%s is required"]);

        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = 'Lab details';
			$data['name'] = 'details';
			$data['operation'] = 'Update';
			$data['url'] = $this->redirect;
			$data['data'] = $this->main->get($this->table, 'details', ['id' => $this->session->auth]);
			
			return $this->template->load('template', 'lab_details', $data);
        }
        else
        {
            $post = [
    			'details' => $this->input->post('details')
    		];

    		$id = $this->main->update(['id' => $this->session->auth], $post, $this->table);

            flashMsg($id, "Lab details updated.", "Lab details not updated.", $this->redirect);
        }
	}
}