<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forex extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');

    }

    public function index()
    {
        $this->template->title("ForexMart | Forex Calendar")
            ->set_layout('external/main')
            ->build('forex/calendar_widget');

    }
    public function calendar_widget()
    {
        $this->template->title("ForexMart | Forex Calendar")
            ->set_layout('external/main')
            ->build('forex/calendar_widget');

    }


    public function calendar()
    {

        $ch = curl_init("https://www.deltastock.com/widgets/economic_calendar_en.xml");
        //$ch = curl_init("http://www.myfxbook.com/rss/forex-economic-calendar-events");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $xml_data = curl_exec($ch);
        $xml = new SimpleXmlElement($xml_data, LIBXML_NOCDATA);
        $cnt = count($xml->channel->item);
        for($i=0; $i<$cnt; $i++)
        {
            $url 	= $xml->channel->item[$i]->link;
            $title 	= $xml->channel->item[$i]->title;
            $desc = $xml->channel->item[$i]->description;
            //$category = $xml->channel->item[$i]->category;
/*
            echo "<ul>";
            echo '<li><a href="'.$url.'">'.$title.'</a><br>'.$desc.'<br><strong>'.$category.'</strong></li>';
            echo "</ul>";*/

        }

        $data = array(
            'xml'   =>   $xml
        );

        $this->template->title("ForexMart | Forex Calendar")
            ->set_layout('external/main')
            ->build('forex/calendar',$data);

    }

    public function calendar1()
    {

        //$ch = curl_init("https://www.deltastock.com/widgets/economic_calendar_en.xml");
        $ch = curl_init("http://www.myfxbook.com/rss/forex-economic-calendar-events");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $xml_data = curl_exec($ch);
        $xml = new SimpleXmlElement($xml_data, LIBXML_NOCDATA);
        //$cnt = count($xml->channel->item);

        echo 'test';

        $data = array(
            'xml'   =>   $xml,
            'table' =>     $this->calendar_table($xml)
        );
        die();

        $this->template->title("ForexMart | Forex Calendar")
            ->set_layout('external/main')
            ->build('forex/calendar_widget',$data);

    }

    public function calendar2()
    {

        //$ch = curl_init("https://www.deltastock.com/widgets/economic_calendar_en.xml");
        $ch = curl_init("http://www.forexfactory.com/ffcal_week_this.xml");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $xml_data = curl_exec($ch);
        $xml = new SimpleXmlElement($xml_data, LIBXML_NOCDATA);
        //$cnt = count($xml->channel->item);

       // var_dump($xml);
        $data = array(
            'xml'   =>   $xml
        );
die();
        $this->template->title("ForexMart | Forex Calendar")
            ->set_layout('external/main')
            ->build('forex/calendar2',$data);

    }

    function calendar_table($xml){
        $dom = new DOMDocument();


        $cnt = count($xml->channel->item);
        for($i=0; $i<$cnt; $i++) {
            $url = $xml->channel->item[$i]->link;
            $title = $xml->channel->item[$i]->title;
            $desc = $xml->channel->item[$i]->description;
            $country = $xml->channel->item[$i]->country_code;
            $previous = $xml->channel->item[$i]->previous;
            $actual = $xml->channel->item[$i]->actual;
            $date = $xml->channel->item[$i]->pubDate;
            $dom->preserveWhiteSpace = false;
            $test = $xml->channel->item[$i]->description;
            $desc = $dom->load($xml->channel->item[$i]->description);
            $table = $dom->getElementsByTagName('table');
//var_dump(simplexml_load_string($test));

            foreach(simplexml_load_string($test) as $key => $tr){

                //foreach($tr as $td){
                if($tr->td){
                    foreach($tr->td as $t){
                        echo "<pre>";
                        var_dump($t);
                        echo "</pre>";
                    }

                }

               // }

            }
            die();
            $rows = $table->item(0)->getElementsByTagName('tr');


            // loop over the table rows
            $ctr = 1;
            foreach ($rows as $tr) {


                //    foreach($table->children('tr') as $tr){
                /**
                 * @var DOMElement $tr
                 */
                // $getTd = $tr->getElementsByTagName('td');
                $cols = $tr->getElementsByTagName('td');
                // $i=0;
                // foreach($getTd as $td){
                /**
                 * @var DOMElement $td
                 */
                $impact = $cols->item[1]->nodeValue;
                $previous = $cols->item[2]->nodeValue;
                $actual = $cols->item[4]->nodeValue;
                var_dump($cols);
                //}
                // ++$i;


                    $tr = '<tr>';
                    $tr.='<td>'.$date.'</td>';
                    $tr.='<td class="f32"><i class="flag '.$country.' "></i> <span class="country-cur">'.$country.'</span></td>';
                    $tr.='<td>';
                    $tr.='    <div class="progress calendar-progress">';
                    $tr.='        <div class="progress-bar progress-bar-'.strtolower($impact).' '.strtolower($impact).' " role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">';
                    $tr.='        </div>';
                    $tr.='    </div>';
                    $tr.='</td>';
                    $tr.='<td><a href=" '.$url.' " data-toggle="modal" data-target="#event" class="calendar-events">'.$title.'></a> <a href="#"><img src="'.$this->template->Images().'forex/prelim-release.png" class="prelim-release"></a></td>';
                    $tr.='<td>'.$actual.'</td>';
                    $tr.='<td></td>';
                    $tr.='<td>'.$previous.'</td>';
                    $tr.='</tr>';
            }
        }

        return $tr;
    }



}
