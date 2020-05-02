<?php

namespace App\Interfaces;

interface BookAdvisor {
    /* An advise is a json composed of
     * a name, a url and possibly an 
     * image source. Example:
     * 
     * {
     *   "title" : "XXXX",
     *   "url" : "https://this.url.com/XXXX",
     *   "cover_url" : "https://this.url.com/XXXX/cover"
     * }
     */
    public function getAdvise($query);
}