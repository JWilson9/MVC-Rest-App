<?php
require_once "DB/pdoDbManager.php";
require_once "DB/DAO/FilmsDAO.php";
require_once "Validation.php";
class FilmModel {
	private $FilmsDAO; // list of DAOs used by this model
	private $dbmanager; // dbmanager
	public $apiResponse; // api response
	private $validationSuite; // contains functions for validating inputs
	public function __construct() {
		$this->dbmanager = new pdoDbManager ();
		$this->FilmsDAO = new FilmsDAO( $this->dbmanager );
		$this->dbmanager->openConnection ();
		$this->validationSuite = new Validation ();
	}
	public function getFilms() {
		return ($this->FilmsDAO->get ());
	}
	public function getFilm($filmID) {
		if (is_numeric ( $filmID ))
			return ($this->FilmsDAO->get ( $filmID ));
		
		return false;
	}
	public function createNewFilm($newFilm) {
		// validation of the values of the new artist
		
		// compulsory values
		if (! empty ( $newFilm ["fname"] )  ) {
			if (($this->validationSuite->isLengthStringValid ( $newFilm ["fname"], TABLE_FILM_NAME_LENGTH)))	
			{
				if ($newId = $this->FilmsDAO->insert ( $newFilm ))
					return ($newId);
			}
		}
		
		// if validation fails or insertion fails
		return (false);
	}
	
	public function searchFilms($string) {
		if (! empty ( $string )) {
			$resultSet = $this->FilmsDAO->search ( $string );
			return $resultSet;
		}
		
		return false;
	}
	
	
	
	public function updateFilm($filmID, $newFilmRepresentation) 
	{
		if (! empty ( $filmID ) && is_numeric ( $filmID )) 
		{
			// compulsory values
			if (! empty ( $newFilmRepresentation ["fname"] )) 
			{
				/*
				 * the model knows the representation of a user in the database and this is: name: varchar(25) surname: varchar(25) email: varchar(50) password: varchar(40)
				 */
				if (($this->validationSuite->isLengthStringValid ( $newFilmRepresentation ["fname"], TABLE_USER_NAME_LENGTH )) )
				{
					$updatedRows = $this->FilmsDAO->update ( $newFilmRepresentation, $filmID );
					if ($updatedRows > 0)
						return (true);
				}
			}
		}
		return (false);
	}
	
	

	public function deleteFilm($filmID) {
		if (is_numeric ( $filmID )) {
			$deletedRows = $this->FilmsDAO->delete ( $filmID );
			if ($deletedRows > 0)
				return (true);
		}
		return (false);
	}
	
	
	public function __destruct() {
		$this->FilmsDAO = null;
		$this->dbmanager->closeConnection ();
	}
}
?>