<?php

    class Todo {

        public $name;
        public $tags = array();

        public function __construct($name, $tags) {

            $this->name = $name;
            
            if (is_array($tags)) {

                $this->tags = $tags;               
        
            } elseif (is_string($tags)) {

                array_push($this->tags, $tags);
            }
        }

        public function addTag($tag) {
            array_push($this->tags, $tag);
        }

        public function getTags() {
            return $this->tags;
        }

    }

?>

