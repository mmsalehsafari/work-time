<?
class TempController {

  public function generateSampleJson(){
    $json = array(
      "Compute Config 1" => array(
        "CPU" => "Intel 4790K",
        "RAM" => "KingStone HyperX 16GB",
      ),
      "Compute Config 2" => array(
        "CPU" => "AMD 965",
        "RAM" => "Patriot 32GB",
      ),
    );
    $jsonEncoded = json_encode($json);
    echo $jsonEncoded;
  }
}