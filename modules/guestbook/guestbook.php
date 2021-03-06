<?php defined('SITE') or die('No direct script access.');

class ModuleGuestbook extends Module {

    public  $module_name   = 'guestbook';
    private $file_name     = 'messages.txt';
    private $notifications = array();
    private $file_path;

    function __construct() {
        parent::__construct();

        $this->file_path =
            Site::buildModulePath($this->module_name, true) .
            $this->file_name;
    }

    public function render() {
        return $this->template->render(array(
            'title' => 'Гостевая книга',
            'module_name' => $this->module_name,
            'notifications' => $this->getNotifications(),
            'messages' => $this->getMessages(),
            'script_path' => $this->script_path
        ));
    }

    public function getNotifications() {
        $result = '';

        if (count($this->notifications) > 0) {
            foreach($this->notifications as $notification) {
                $result .= Site::printMessage($notification['text'], $notification['theme'], true);
            }
        }

        return $result;
    }

    public function action_add() {
        if (!count($_POST)) return;

        if ($_POST['first-name'] && $_POST['message']) {
            $handle = fopen($this->file_path, 'a+');

            if ($handle) {
                $date = date('d.m.Y H:m:i');

                if (fwrite($handle, "{$_POST['first-name']}: {$_POST['message']} ({$date}) \n")) {
                    array_push($this->notifications, array(
                        'text' => 'Запись добавлена!',
                        'theme' => MESSAGE_SUCCESS)
                    );
                }
                fclose($handle);
            } else {
                array_push($this->notifications, array(
                    'text' => "Не могу открыть файл: {$this->file_path} для записи",
                    'theme' => MESSAGE_FAIL)
                );
            }
        } else {
            array_push($this->notifications, array(
                'text' => 'Плохие данные!',
                'theme' => MESSAGE_FAIL)
            );
        }
    }

    private function getMessages() {
        $fsize = @filesize($this->file_path); // FYI: оператор @ подавляет вывод ошибок

        if (file_exists($this->file_path) && $fsize) {
            if ($fsize) {
               $handle = fopen($this->file_path, 'rt');
               $data = fread($handle, $fsize);
               fclose($handle);
               return nl2br(htmlspecialchars($data));
           }
        } else {
            return Site::printMessage('Сообщений нет', MESSAGE_NORMAL, true);
        }
    }

    function after() {
        Section::pushStack($this->module_name, $this->render());
    }

}
