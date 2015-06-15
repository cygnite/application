<?php
namespace Apps\Resources\Extensions;

class SocialShare
{
    public function __construct(\Apps\Resources\Extensions\Custom $custom)
    {
        show($custom);
    }

    public function hello()
    {
        echo "Hello Social Share Extension";
    }
}
