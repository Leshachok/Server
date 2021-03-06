<?php
/**
 * User Controller
 *
 * @author Serhii Shkrabak
 * @global object $CORE->model
 * @package Model\Main
 */
namespace Model;
class Main
{
	use \Library\Shared;

	public function formsubmitAmbassador(array $data):?array {
		// Тут модель повинна бути допрацьована, щоб використовувати бази даних, тощо
		$key = '1699643349:AAHaM-YngmbPncm1oKkjTH4djA4U7TQ-Ca8'; // Ключ API телеграм
		$result = null;
		$chat = 499885407;
		// if( !isset($data['firstname']) || !isset($data['secondname']) || !isset($data['position']) || !isset($data['phone']) ) 
		// 	$text = 'Введіть всі дані'; 
		// else 
		// 	
		$text = "Нова заявка в *Цифрові Амбасадори*:\n" . $data['firstname'] . ' '. $data['secondname']. ', '. $data['position'] . "\n*Зв'язок*: " . $data['phone'];
		$text = urlencode($text);
		
		$answer = file_get_contents("https://api.telegram.org/bot$key/sendMessage?parse_mode=markdown&chat_id=$chat&text=$text");
		$answer = json_decode($answer, true);
		$result = ['message' => $answer['result']];
		
		return $result;
	}

	public function __construct() {

	}
}