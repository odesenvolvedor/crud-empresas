<?php
namespace App\Controllers;

use App\Validators\Validator;
use Dompdf\Dompdf;

class Controller
{
    /** 
     * @var String $layout 
     */
    private $layout = "default";

    /** 
     * @var array $rules 
     */
    protected $rules;

    /**
     * @var array $messages 
     */
    protected $messages;


    /**
     * Renderiza o layout da aplicação e a view solicitada pelo controller
     * @access  public
     * @var     String $filename
     * @var     array $data
     * 
     * @return  void
     */
    public function render($filename, $data = [])
    {        
        extract($data);

        ob_start();

        require ROOT . "resources/views/" . str_replace('.', '/', $filename) . '.php';

        $content_for_layout = ob_get_clean();

        unset($_SESSION['errors']);
        unset($_SESSION['old']);

        if ($this->layout == false) {
            $content_for_layout;
        } else {
            require ROOT . "resources/views/layouts/" . $this->layout . '.php';
        }
    }

    
    /**
     * Limpa string contra sql injection
     * @access  private
     * @var     String $data
     * 
     * @return  String $data
     */
    private function secure_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    /**
     * Limpa formulário contra sql injection
     * @access  protected
     * @var     array $form
     * 
     * @return  array $form
     */
    protected function secure_form($form)
    {
        foreach ($form as $key => $value) {
            $form[$key] = $this->secure_input($value);
        }
        return $form;
    }


    /**
     * Realiza validação do formulário
     * @access  protected
     * @var     mixed $request
     * 
     * @return  void
     */
    protected function validate($request)
    {
        $validator = new Validator($this->rules, $request, $this->messages);
    }

}
