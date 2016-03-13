<?php
namespace Controllers;

use Carbon\Carbon;
use Models\Birthday;

/**
 * Controller for the main pages displayed in this app
 *
 * Class HomeController
 * @package Controllers
 */
class HomeController extends BaseController
{
    /**
     * Creates the index page for the app showing all the birthdays
     */
    public function getIndex()
    {
        return $this->view('home.php', ['birthdays' => Birthday::all()]);
    }

    /**
     * Handles people submitting the form and displaying the index page
     */
    public function postIndex()
    {
        // Saves the form changes, nice and simple since eloquent escapes the values
        $birthday = new Birthday();
        $birthday->name = $_POST['name'];
        // Dob has to be a date time, Carbon is a nice class that eloquent prefers
        $birthday->dob = new Carbon($_POST['dob']);
        $birthday->save();

        return $this->view('home.php', [
            'birthday' => $birthday,
            'diff' => $birthday->diff(),
            'birthdays' => Birthday::all(),
        ]);
    }
}