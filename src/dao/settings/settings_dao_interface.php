<?php

interface settings_dao_interface
{
    public function find_by_id($settings_id): settings;
    public function update(settings $settings):bool;

}

?>