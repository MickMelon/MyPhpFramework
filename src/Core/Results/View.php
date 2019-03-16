<?php
namespace Core\Results;

use Core\Results\IActionResult;

class View implements IActionResult
{
    /**
     * The path to the header file.
     */
    const HEADER_FILE = 'src/App/Views/header.php';

    /**
     * The path to the footer file.
     */
    const FOOTER_FILE = 'src/App/Views/footer.php';

    /**
     * The variables used on the view page.
     */
    private $data = array();

    /**
     * The file location of the view page to be displayed (located in app/Views)
     */
    private $file = false;

    /**
     * Create a new view from the specified template name.
     * 
     * @param string $template The template name (e.g. Articles/index)
     * 
     * @return View
     */
    public function __construct(string $template)
    {
        $file = 'src/App/Views/' . $template . '.php';
        
        if (file_exists($file)) 
            $this->file = $file;
        else 
            $this->file = 'src/App/Views/Pages/error.php'; 
    }

    public function execute()
    {
        extract($this->data); 

        include(self::HEADER_FILE);
        include($this->file);
        include(self::FOOTER_FILE);
    }

    /**
     * Add the variables that need to be displayed on the view.
     * 
     * Example use:
     * $value = 'Number 21'
     * $view->assign('name', $value);
     * 
     * So in the view, you use the variable like $name to access the value set
     * in $value.
     * 
     * @param string $variable The desired name of the variable.
     * @param object $value The value of the variable to be used.
     * 
     * @return void
     */
    public function assign(string $variable, $value)
    {
        $this->data[$variable] = $value;
    }

    public static function error(string $error = 'Unspecified Error')
    {
        $result = new View('Pages/error');
        $result->assign('error', $error);
        return $result;
    }
}