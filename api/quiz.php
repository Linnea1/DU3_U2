<?php
$method=$_SERVER["REQUEST_METHOD"];
$file="dogs.json";
$array_of_dogs=["Afghan Hound", "Australian Shepherd", "Beagle", "Bearded Collie", "Boston Terrier", "Boxer", "Bulldog", "Cane Corso", "Chihuahua", "Collie", "French Bulldog", "German Shepherd", "Giant Schnauzer", "Golden Retriever", "Greyhound", "Jack Russel Terrier", "Labrador Retriever", "Leonberger", "Miniature Schnauzer"];

if($method=="GET"){
   if(!file_exists($file)){
    file_put_contents($file,"{}");
   
    $dogs_json= file_get_contents("dogs.json");
    $dogs=json_decode($dogs_json, true);
    $dog_alternatives=[];
    foreach($array_of_dogs as $index=>$dog){
        $image=str_replace(" ", "_", $dog);
        $image_ending=".jpg";
        $image.=$image_ending;
        $dogs[$dog]=["id"=>$index, "dog"=>$dog, "image"=>$image];
        $dogs_json=json_encode($dogs, JSON_PRETTY_PRINT);
        file_put_contents("dogs.json", $dogs_json);
    }
}
function get_dog(&$dog_alternatives) {
    $random_number = rand(0, count($array_of_dogs)-1);
    if(!in_array($random_number, $dog_alternatives)){
        $dog_alternatives[]=$random_number;
    }else{
        get_dog($dog_alternatives);
    }
    return $random_number;
}
for($i=0;$i<3;$i++){
    get_dog($dog_alternatives);
}
   
}u
?>