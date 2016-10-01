<?php


class UserActivitiesModel extends BaseModel {

	/**
	 *
	 *
	 */
	public function findAll() {
		return parent::find()->where('deleted', '0000-00-00 00:00:00') ;
	}
}



