<?php
// thanks to philipsharp https://gist.github.com/philipsharp/7529724 :)
class PlatesView extends \Slim\View
{
    /**
     * @var \League\Plates\Engine
     */
    protected $_engineInstance;

    /**
     * Override for the default file extension
     *
     * @var string
     */
    public $fileExtension;

    public function getInstance()
    {
        if (!$this->_engineInstance) {
            // Create new Plates engine
            $this->_engineInstance = new \League\Plates\Engine($this->getTemplatesDirectory());

            if ($this->fileExtension){
                $this->_engineInstance->setFileExtension($this->fileExtension);
            }
        }

        return $this->_engineInstance;
    }

    public function render($template){
        $platesTemplate = new \League\Plates\Template($this->getInstance());
        $platesTemplate->data($this->all());
        return $platesTemplate->render($template);
    }
}