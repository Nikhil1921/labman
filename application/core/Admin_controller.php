<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Admin_controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->auth) 
			return redirect(admin('login'));

        $this->user = (object) $this->main->get("logins", 'name, mobile, email', ['id' => $this->session->auth]);
		$this->redirect = admin($this->redirect);
		$this->app_table = $this->config->item('app_table');
	}

	protected function uploadImage($upload, $exts='jpg|jpeg|png', $size=[], $name=null, $thumb=[])
    {
        $this->load->library('upload');
        $config = [
                'upload_path'      => $this->path,
                'allowed_types'    => $exts,
                'file_name'        => $name ? $name : time(),
                'file_ext_tolower' => TRUE,
                'overwrite'        => FALSE
            ];
            
        $config = array_merge($config, $size);
        
        $this->upload->initialize($config);
        
        if ($this->upload->do_upload($upload)){
            if ($thumb) {
                $this->load->library('image_lib');
                $t_config['image_library'] = 'gd2';
                $t_config['source_image'] = $this->upload->data('full_path');
                $t_config['new_image'] = $this->path."thumb/";
                $t_config['maintain_ratio'] = TRUE;
                $t_config = array_merge($t_config, $thumb);
                $this->image_lib->initialize($t_config);
                $this->image_lib->resize();
                $this->image_lib->clear();
                $img_th = $this->upload->data("file_name");
                $name_th = $this->upload->data("raw_name");
                
                if (in_array($this->upload->data('file_ext'), ['.jpg', '.jpeg']))
                    $image_th = imagecreatefromjpeg($this->path."thumb/".$img_th);
                if ($this->upload->data('file_ext') == '.png')
                    $image_th = imagecreatefrompng($this->path."thumb/".$img_th);

                if (isset($image_th)){
                    convert_webp($this->path."thumb/", $image_th, $name_th);
                    unlink($this->path."thumb/".$img_th);
                    $img_th = "$name_th.webp";
                }
            }

            $img = $this->upload->data("file_name");
            $name = $this->upload->data("raw_name");
            
            if (in_array($this->upload->data('file_ext'), ['.jpg', '.jpeg']))
                $image = imagecreatefromjpeg($this->path.$img);
            if ($this->upload->data('file_ext') == '.png')
                $image = imagecreatefrompng($this->path.$img);

            if (isset($image)){
                convert_webp($this->path, $image, $name);
                unlink($this->path.$img);
                $img = "$name.webp";
            }
            
            return ['error' => false, 'message' => $img];
        }else
            return ['error' => true, 'message' => $this->upload->display_errors()];
    }

    public function getSubCats()
    {
        check_ajax();
        
        $return = array_map(function($ins){
            return ['val' => e_id($ins['id']), 'cat_name' => $ins['cat_name']];
        }, $this->main->getall("category", 'id, cat_name', ['is_deleted' => 0, 'parent_id' => d_id($this->input->get('cat_id'))]));
        
        die(json_encode($return));
    }
}