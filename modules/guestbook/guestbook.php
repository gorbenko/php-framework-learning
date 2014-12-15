<?php defined('SITE') or die('No direct script access.');

class ModuleGuestbook extends Module {

    private $module_name = 'guestbook';
    private $file_name   = 'messages.txt';
    private $messages    = array();
    private $file_path;

    function __construct() {
        $this->file_path =
            Site::buildModulePath($this->module_name, true) .
            DIRECTORY_SEPARATOR .
            $this->file_name;
    }

    public function render() {
        // TODO: использовать шаблонизатор

        return <<<EOT
            <h2 class="title">Гостевая книга</h2>
            {$this->getNotifications()}
            <form method="post"
                class="{$this->module_name}-form"
                name="{$this->module_name}-form"
                action="?mod=$this->module_name&action=add"
            >
                <p><input name="first-name" class="guestbook-form-first-name" placeholder="Имя"></p>
                <p><textarea name="message" class="guestbook-form-message" placeholder="Сообщение"></textarea></p>
                <p class="guestbook-button"><input type="submit" value="Отправить"></p>
            </form>
            <div class="{$this->module_name}-board">
                {$this->getMessages()}
            </div>
EOT;
    }

    public function getNotifications() {
        $result = '';

        if (count($this->messages) > 0) {
            foreach($this->messages as $message) {
                $result .= "<div class='message message-{$message['theme']}'>{$message['text']}</div>";
            }
        }

        return $result;
    }

    public function action_add() {
        if ($_POST['first-name'] && $_POST['message']) {
            $handle = fopen($this->file_path, 'a+');
            if ($handle) {
                $date = date('d.m.Y H:m:i');
                if (fwrite($handle, "{$_POST['first-name']}: {$_POST['message']} ({$date}) \n")) {
                    array_push($this->messages, array(
                        'text' => 'Запись добавлена!',
                        'theme' => MESSAGE_SUCCESS)
                    );
                }
                fclose($handle);
            } else {
                array_push($this->messages, array(
                    'text' => "Не могу открыть файл: {$this->file_path} для записи",
                    'theme' => MESSAGE_FAIL)
                );
            }
        } else {
            array_push($this->messages, array(
                'text' => 'Плохие данные!',
                'theme' => MESSAGE_FAIL)
            );
        }
//        header('Location: /');
    }

    private function getMessages() {
        $fsize = @filesize($this->file_path); // оператор @ подавляет вывод ошибок
        if (file_exists($this->file_path) && $fsize) {
           if ($fsize) {
               $handle = fopen($this->file_path, 'rb');
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
