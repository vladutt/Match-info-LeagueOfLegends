<?php 

Class Api {

    protected $region = 'EUN1';
    protected $key = 'YOUR KEY ID';
    

    public function getSummonerIdByName($Summoner){

        $url = "https://eun1.api.riotgames.com/lol/summoner/v3/summoners/by-name/".$Summoner."?api_key=".$this->key;

        $result = $this->curl($url);

        if($this->check_url($result)){
            return $result['id'];
        }else{
            $_SESSION['alert'] = "- Wrong name <br> - The game not started <br> - The server are overloded";
            header('Location: ./');
            exit;
        }

    }

    public function currentGame($id){

        $url = "https://eun1.api.riotgames.com/lol/spectator/v3/active-games/by-summoner/".$id."?api_key=".$this->key;
       
        $game = $this->curl($url);

        if($this->check_url($game)){
            return $game;
        }else{
            $_SESSION['alert'] = "- Wrong name <br> - The game not started <br> - The servers are overloded";
            header('Location: ./');
            exit;
        }

    }

    private function curl($url){

        $ch =  curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        $result = curl_exec($ch);
        $result = json_decode($result, true);
        return $result;
        curl_close($result);

    }

    private function check_url($result){

        if(isset($result['status']['status_code'])){
            return false;
        }else{
            return true;
        }

    }

    public function champions($id){

        $version = $this->curl('https://ddragon.leagueoflegends.com/api/versions.json');

        $file = $this->curl("http://ddragon.leagueoflegends.com/cdn/".$version[0]."/data/en_US/champion.json");

        $Champions = [];

        foreach($file['data'] as $data){
            $Champions[$data['key']] = [
                'name' => $data['name'],
                'image' => $data['image']['full']
            ];
        }
        
            if(isset($Champions[$id])){

                if($Champions[$id]['name'] === 'LeBlanc'){
                    return 'Leblanc';
                }
                if($Champions[$id]['name'] === "Rek'Sai"){
                    return 'RekSai';
                }
                if(strpos($Champions[$id]['name'], "'")){
                    
                    $new = str_replace("'", "", $Champions[$id]['name']);
                    $new = strtolower($new);
                    return ucwords($new);
                }


                return str_replace(" ", "", $Champions[$id]['name']);
            }else{
                return 'Aatrox';
            }

    }

    public function checkRank($id){

        $rank = $this->curl("https://eun1.api.riotgames.com/lol/league/v3/positions/by-summoner/".$id."?api_key=".$this->key);

        if(isset($rank[0]) && $rank[0]['queueType']  === 'RANKED_SOLO_5x5'){

            return $rank[0]['tier']." ".$rank[0]['rank'];

        }else if(isset($rank[1]) && $rank[1]['queueType'] === 'RANKED_SOLO_5x5'){

            return $rank[1]['tier']." ".$rank[1]['rank'];

        }else if(isset($rank[2]) && $rank[2]['queueType'] === 'RANKED_SOLO_5x5'){

            return $rank[2]['tier']." ".$rank[2]['rank'];

        }else{
            return 'Unranked';
        }

    }

}