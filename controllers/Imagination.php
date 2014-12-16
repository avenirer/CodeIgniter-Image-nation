<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Imagination extends CI_Controller {


    public function index()
    {
        // first, let's load the library
        $this->load->library('image_nation');



        // with source() method you can add images. The library will look for the image inside de default source folder that is set in the configuration file
        $this->image_nation->source('source-image-01.jpg');
        $this->image_nation->source('source-image-02.jpg');
        $this->image_nation->source('source-image-03.jpg');

        // you can also add more than one image in one step by passing them in an array
        // $this->image_nation->source(array('source-image-01.jpg','source-image-02.jpg','source-image-03.jpg'));

        //you can add sources by mentioning full path, if you do this the second parameter must be set to TRUE
        //$this->image_nation->source(array(FCPATH.'upload/source-image-01.jpg', FCPATH.'upload/source-image-02.jpg'),TRUE);

        // you can reset the sizes. clear_sizes() method erases all default sizes set inside the config file
        //$this->image_nation->clear_sizes();

        // you can add or modify a size by using add_size() method and passing it an array

        $dimensions = array(
            '200x200' => array(
                'master_dim'    =>  'width',
                'keep_aspect_ratio' => FALSE,
                'style'         =>  array('vertical'=>'center','horizontal'=>'center'),
                'overwrite'     =>  TRUE,
                'quality'       =>  '70%',
                'directory'   =>  'test',
                'file_name'   =>  'test_me'
            )
        );
        //$this->image_nation->add_size($dimensions);

        $images = $this->image_nation->process();

        //if you've set alot of available dimensions in the configuration file, you can also process only specific dimension(s). ** ATTENTION: IT ONLY WORKS IF THE DIMENSIONS MENTIONED ARE PRESENT IN THE DEFAULT DIMENSIONS **
        //$this->image_nation->process('400x350|500x200');

        // you can also process only the dimensions you want by passing the array with the dimensions
        //$this->image_nation->process($dimension)

        // don't do this at home... use the views for output
        print_r($images);

        // get_errors() method is returning the eventual errors, or, if there were no errors, will return FALSE
        if(!$this->image_nation->get_errors()) {
            echo 'Images were created';
            // get_processed() method returns the processed images' paths
            $processed_images = $this->image_nation->get_processed();


            // don't do this at home... use the views to output
            echo '<pre>';
            print_r($processed_images);
            echo '</pre>';
        }
    }

    public function verifyimglib()
    {
        $config = array(
            'image_library' => 'gd2',
            'create_thumb' =>FALSE,
            'source_image' => 'D:/Dropbox/server/basicsetup/upload/chinatwo.jpg',
            'quality' => '100%',
            'new_image' => 'D:/Dropbox/server/basicsetup/upload/200x200/chinatwo.jpg',
            'width' => '1098',
            'height' => '1098',
            'y_axis' => '280');

        $this->load->library('image_lib');
        $this->image_lib->initialize($config);
        $this->image_lib->crop();
    }



}

/* End of file Imagination.php */
/* Location: ./application/controllers/Imagination.php */