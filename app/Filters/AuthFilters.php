<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilters implements FilterInterface {

    public function before(RequestInterface $request, $arguments = null) {
        
        if(session()->get('isLogin') == TRUE && session()->get('role') == "Admin") {
        }else{
            return redirect()->to(base_url('/')); 
        }
    }
    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        // Do something here
    }

}