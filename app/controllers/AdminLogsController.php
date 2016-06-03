<?php
use App\LaravelLogViewer\LaravelLogViewer;

class AdminLogsController extends AdminController {

    public function index()
    {

        try{

            Log::info('Enterning to Log Method');
            
            if (\Input::get('dl')) {
                return \Response::download(storage_path() . '/logs/' . \Input::get('dl'));
            } elseif (\Input::has('del')) {
                \File::delete(storage_path() . '/logs/' . \Input::get('del'));
                return Redirect::to(Config::get('app.evezown_url').'/admin/logs');
            }

            $logs = LaravelLogViewer::all();

            $successResponse = [
              'status' => true,
              'logs'   => $logs,
              'files'  => LaravelLogViewer::getFiles(true),
              'current_file' => LaravelLogViewer::getFileName()

            ];

            return $this->setStatusCode(200)->respond($successResponse);
            

        }catch(Exception $e){

            Log::error('Error In Log Method');

            return $this->setStatusCode(500)->respond($e);

        }
        
    }

}
