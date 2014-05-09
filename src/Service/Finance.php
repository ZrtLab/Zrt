<?php


class Zrt_Service_Finance
{


    public function __construct()
    {
        
    }


    public function getCountryIp()
    {
        $currency = new Zend_Currency() ;
        $countryCode = $this->getCountryFromIP() ;
        $currencyCode = $currency->getCurrencyList( $countryCode ) ;
        $localCurrency = $this->currency( 'USD' ,
                                          $currencyCode[0] ,
                                          50 ) ;
        $var['currencyCode'] = $currencyCode[0] ;
        $var['currency'] = $localCurrency ;
        return $var ;


    }


    /**
     *
     *
     * @param type $from_Currency
     * @param type $to_Currency
     * @param type $amount
     * @return type valor de la moneda
     */
    public static function currency( $from_Currency , $to_Currency , $amount )
    {

        if ( $to_Currency == 'CLP' )
        {
            $precio = $amount ;
            $amount = 1 ;
            $from_Currency = urlencode( $from_Currency ) ;
            $to_Currency = urlencode( $to_Currency ) ;

            $url =
                    "http://www.google.com/ig/calculator?hl=en&q=$amount$from_Currency=?$to_Currency" ;

            $ch = curl_init() ;
            $timeout = 0 ;
            curl_setopt( $ch ,
                         CURLOPT_URL ,
                         $url ) ;
            curl_setopt( $ch ,
                         CURLOPT_RETURNTRANSFER ,
                         1 ) ;
            curl_setopt( $ch ,
                         CURLOPT_USERAGENT ,
                         "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)" ) ;
            curl_setopt( $ch ,
                         CURLOPT_CONNECTTIMEOUT ,
                         $timeout ) ;
            $rawdata = curl_exec( $ch ) ;


            curl_close( $ch ) ;
            $data = explode( '"' ,
                             $rawdata ) ;
            $data = explode( ' ' ,
                             $data['3'] ) ;

            $stripped = preg_replace( "/[^A-Za-z0-9.\+]/" ,
                                      "" ,
                                      $data['0'] ) ; //remove special char

            return round( $stripped * $precio ,
                          0 ,
                          PHP_ROUND_HALF_UP ) ;
        }

        $amount = urlencode( $amount ) ;
        $from_Currency = urlencode( $from_Currency ) ;
        $to_Currency = urlencode( $to_Currency ) ;

        $url =
                "http://www.google.com/ig/calculator?hl=en&q=$amount$from_Currency=?$to_Currency" ;

        $ch = curl_init() ;
        $timeout = 0 ;
        curl_setopt( $ch ,
                     CURLOPT_URL ,
                     $url ) ;
        curl_setopt( $ch ,
                     CURLOPT_RETURNTRANSFER ,
                     1 ) ;
        curl_setopt( $ch ,
                     CURLOPT_USERAGENT ,
                     "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)" ) ;
        curl_setopt( $ch ,
                     CURLOPT_CONNECTTIMEOUT ,
                     $timeout ) ;
        $rawdata = curl_exec( $ch ) ;


        curl_close( $ch ) ;
        $data = explode( '"' ,
                         $rawdata ) ;
        $data = explode( ' ' ,
                         $data['3'] ) ;

        $stripped = preg_replace( "/[^A-Za-z0-9.\+]/" ,
                                  "" ,
                                  $data['0'] ) ; //remove special char

        return round( $stripped ,
                      0 ,
                      PHP_ROUND_HALF_UP ) ;


    }


    public static function getCurrencyMoney( $from_Currency , $to_Currency ,
                                             $amount )
    {
        $amount = urlencode( $amount ) ;
        $from_Currency = urlencode( $from_Currency ) ;
        $to_Currency = urlencode( $to_Currency ) ;
        $url = "http://www.google.com/ig/calculator?hl=en&q=$amount$from_Currency=?$to_Currency" ;
        $ch = curl_init() ;
        $timeout = 0 ;
        curl_setopt( $ch ,
                     CURLOPT_URL ,
                     $url ) ;
        curl_setopt( $ch ,
                     CURLOPT_RETURNTRANSFER ,
                     1 ) ;
        curl_setopt( $ch ,
                     CURLOPT_USERAGENT ,
                     "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)" ) ;
        curl_setopt( $ch ,
                     CURLOPT_CONNECTTIMEOUT ,
                     $timeout ) ;
        $rawdata = curl_exec( $ch ) ;
        curl_close( $ch ) ;

        $rawdata = Zrt_Tools_Text::addJsonComillas( $rawdata ) ;
        $rawdata = Zend_Json::decode( $rawdata ,
                                      Zend_Json::TYPE_OBJECT ) ;

        return Zrt_Tools_Text::cleanTexto( $rawdata->rhs ) ;


    }


    public static function getCurrencyMoneyText( $from_Currency , $to_Currency ,
                                                 $amount )
    {
        $amount = urlencode( $amount ) ;
        $from_Currency = urlencode( $from_Currency ) ;
        $to_Currency = urlencode( $to_Currency ) ;
        $url = "http://www.google.com/ig/calculator?hl=en&q=$amount$from_Currency=?$to_Currency" ;
        $ch = curl_init() ;
        $timeout = 0 ;
        curl_setopt( $ch ,
                     CURLOPT_URL ,
                     $url ) ;
        curl_setopt( $ch ,
                     CURLOPT_RETURNTRANSFER ,
                     1 ) ;
        curl_setopt( $ch ,
                     CURLOPT_USERAGENT ,
                     "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)" ) ;
        curl_setopt( $ch ,
                     CURLOPT_CONNECTTIMEOUT ,
                     $timeout ) ;
        $rawdata = curl_exec( $ch ) ;
        curl_close( $ch ) ;

        $rawdata = Zrt_Tools_Text::addJsonComillas( $rawdata ) ;
        $rawdata = Zend_Json::decode( $rawdata ,
                                      Zend_Json::TYPE_OBJECT ) ;

        return $rawdata->rhs ;


    }


    //get ip-address and show country code


    public static function getCountryFromIP()
    {
        $ip = $_SERVER['REMOTE_ADDR'] ;
        $country = exec( "whois $ip  | grep -i country" ) ; // Run a local whois and get the result back
        //$country = strtolower($country); // Make all text lower case so we can use str_replace happily
        // Clean up the results as some whois results come back with odd results, this should cater for most issues
        $country = str_replace( "country:" ,
                                "" ,
                                "$country" ) ;
        $country = str_replace( "Country:" ,
                                "" ,
                                "$country" ) ;
        $country = str_replace( "Country :" ,
                                "" ,
                                "$country" ) ;
        $country = str_replace( "country :" ,
                                "" ,
                                "$country" ) ;
        $country = str_replace( "network:country-code:" ,
                                "" ,
                                "$country" ) ;
        $country = str_replace( "network:Country-Code:" ,
                                "" ,
                                "$country" ) ;
        $country = str_replace( "Network:Country-Code:" ,
                                "" ,
                                "$country" ) ;
        $country = str_replace( "network:organization-" ,
                                "" ,
                                "$country" ) ;
        $country = str_replace( "network:organization-usa" ,
                                "us" ,
                                "$country" ) ;
        $country = str_replace( "network:country-code;i:us" ,
                                "us" ,
                                "$country" ) ;
        $country = str_replace( "eu#countryisreallysomewhereinafricanregion" ,
                                "af" ,
                                "$country" ) ;
        $country = str_replace( "" ,
                                "" ,
                                "$country" ) ;
        $country = str_replace( "countryunderunadministration" ,
                                "" ,
                                "$country" ) ;
        $country = str_replace( " " ,
                                "" ,
                                "$country" ) ;

        return $country ;


    }


}