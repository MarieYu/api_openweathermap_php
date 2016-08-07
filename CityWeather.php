<?php


class CityWeather{
	private $data;
	
	public function __construct($data){
		$this->measureDate = $data->dt;
		$this->sunrise = $data->sys->sunrise;
		$this->sunset = $data->sys->sunset;
		$this->humidity = $data->main->humidity;
		$this->pressure = $data->main->pressure;
		$this->windSpeed = $data->wind->speed;
		$this->icon = $data->weather[0]->icon;
		$this->tempK = $data->main->temp;
		$this->latitude = $data->coord->lat;
		$this->longitude = $data->coord->lon;		
	}
	

	/**
	 * To format time
	 * @param string $enterTime : date in timestamp
	 * @return string : hours with 24h format
	 */
	private function formatTime($enterTime){
		$date = strftime('%H:%M', $enterTime);
		return str_replace(':', 'h', $date);
	}

	/**
	 * To format date
	 * @param string $enterDate : date in timestamp
	 * @return string : date with french format
	 */
	private function formatDateFR($enterDate){
		return strftime('%d/%m/%Y', $enterDate); 
	}

	/**
	 * To get month in french from its number
	 * @param int $numMonth : month number
	 * @return string : month
	 */
	private function getMonth($numMonth){
		$months = [
			"1" => "janvier",
			"2" => "février",
			"3" => "mars",
			"4" => "avril",
			"5" => "mai",
			"6" => "juin",
			"7" => "juillet",
			"8" => "août",
			"9" => "septembre",
			"10" => "octobre",
			"11" => "novembre",
			"12" => "décembre",
		];
		foreach ($months as $month => $value){
			if ($month === $numMonth){
				return $months[$month];
			}
		}
	}

	/**
	 * To get measure date in jj/mm/aaaa format
	 * @return string : date
	 */
	public function getMeasureDate(){
		$measure = $this->measureDate;
		return $this->formatTime($measure);
	}

	/**
	 * To get measure date "day month" format
	 * @return string : date
	 */
	public function getDateFR(){
		$measure = getDate($this->measureDate);
		return ($measure['mday']." ".$this->getMonth($measure['mon']));
	}

	/**
	 * To get sunrise hour in 24h format
	 * @return string : sunrise hour
	 */
	public function getSunriseHourFR(){
		$sunrise = $this->sunrise;
		return $this->formatTime($sunrise);
	}

	/**
	 * To get sunset hour in 24h format
	 * @return string : sunset hour
	 */
	public function getSunsetHourFR(){
		$sunset = $this->sunset;
		return $this->formatTime($sunset);
	}

	/**
	 * To get humidity percent
	 * @return string : humidity
	 */
	public function getHumidity(){
		return $this->humidity.' %';
	}

	/**
	 * To get pressure in hPa
	 * @return string : pressure
	 */
	public function getPressure(){
		return floor($this->pressure).' hPa';
	}

	/**
	 * To get wind speed in km/h
	 * @return string : wind speed
	 */
	public function getWindSpeedFR(){
		return floor($this->windSpeed*3600/1000).' km/h';
	}

	/**
	 * To get icon code for weather picture
	 * @return string : icon code
	 */
	public function getIconId(){
		return $this->icon;
	}

	/**
	 * To get temperature in °C
	 * @return string : temp °C
	 */
	public function getTempC(){
		return floor($this->tempK-273.15).'°C';
	}

	/**
	 * To get city latitude
	 * @return float : latitude
	 */
	public function getLat(){
		return $this->latitude;
	}

	/**
	 * To get city longitude
	 * @return float : longitude
	 */
	public function getLon(){
		return $this->longitude;
	}


}

?>