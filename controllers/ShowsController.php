<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once(__DIR__."/../connection/connection.php");
require_once(__DIR__."/../models/Show.php");
require_once(__DIR__."/../models/Movie.php");
require_once(__DIR__."/../models/Auditorium.php");
require_once(__DIR__."/../models/Category.php");
require_once(__DIR__."/BaseController.php");

class ShowsController extends BaseController{
    public function getShows(){
        try{
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $input = json_decode(file_get_contents("php://input"), true);
    
                if (isset($input["date"])) {
        $date = $input["date"];
        $shows = Show::findByDate($this->mysqli, $date);
        if ($shows) {
            $response["shows"] = [];
            foreach ($shows as $show) {
                $movie = Movie::find($this->mysqli, $show->getMovieId());
                $auditorium = Auditorium::find($this->mysqli, $show->getauditoriumId());
                $categories = Category::getMovieCategory($this->mysqli, $show->getMovieId());
                $response["shows"][] = [
                    "show" => $show->toArray(),
                    "movie" => $movie->toArray(),
                    "auditorium" =>$auditorium->toArray(),
                    "categories"=>$categories,
                ];
            }
            BaseController::success_response($response);
            return;

        } else {
            BaseController::error_response("No shows found for this date.");
            return;
        }
    }
} 
}catch (Exception $e) {
    BaseController::error_response($e->getMessage());
}
    }
    public function numShows(){
        try{
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $input = json_decode(file_get_contents("php://input"), true);
    
    if (isset($input["date"])) {
        $date = $input["date"];
        $showsNum = Show::todayShowsNum($this->mysqli, $date);
        if ($showsNum) {
            BaseController::success_response($showsNum);
            return;
        } else {
            BaseController::error_response("No shows for today");
            return;
        }
    }
}
        }
        catch (Exception $e) {
            BaseController::error_response($e->getMessage());}
    }
}