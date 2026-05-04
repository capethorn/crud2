    <?php
    require_once "BaseController.php"; 

    class TwigBaseController extends BaseController {
        public $title = ""; // название страницы
        public $template = ""; // шаблон страницы
        protected \Twig\Environment $twig; 
        
    
        public function __construct($twig)
        {
            $this->twig = $twig; // пробрасываем его внутрь
        }
        
        public function getContext() : array
        {
            $context = parent::getContext(); // вызываем родительский метод
            $context['title'] = $this->title; // добавляем title в контекст

            return $context;
        }
        

        public function get() { 
            echo $this->twig->render($this->template, $this->getContext());
        }
    }