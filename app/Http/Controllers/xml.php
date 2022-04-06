<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class xml extends Controller
{
    /**
     * 
     * composer require bmatovu/laravel-xml
     * composer require mtownsend/response-xml
     * php artisan optimize
     */

    //xml
    public function showMovies(){
        //return 'wow';
        
        //return response()->xml($xmlArray, 200, [], 'mirui',"UTF-8");
        //dump(self::getMovie());
        return response()->xml(self::getMovie(), 200, [], ['root' => 'mirui']);
    }

    /**
     * xslt
     * 
     * find extension=xsl on c:/bin/php.ini, remove ; in front
     */
    public function showXSLTMovie(){
        // $retXml = $this->returnXML();
        // dump($retXml);
        
        // $xml = new \DOMDocument;
        // $xml->load($retxml);
        // dump($xml);
        
        $xml = new \DOMDocument;
        // xml_encode: https://github.com/mtvbrianking/laravel-xml/blob/master/src/Support/helpers.php
        $xml->loadXML(xml_encode(self::getMovie(), 'mirui'));
        // dump($xml);

        $xsl = new \DOMDocument;
        $xsl->load(resource_path('xml/movie.xsl'));
        //dump($xsl);

        $proc = new \XSLTProcessor;
        $proc->importStyleSheet($xsl);

        return $proc->transformToXML($xml);
    } 

    public function getMovie(){
        $movieArray = [];
        foreach(Movie::all() as $movie){
            $movie = 
                [
                    '_attributes' => [
                        'id' => $movie->id,
                    ],
                    'title' => [
                        'primary' => $movie->title,
                        'secondary' => $movie->title2,
                    ],
                    'description' => [
                        'primary' => $movie->description,
                        'secondary' => $movie->description2,
                    ],    
                    'genre' => $movie->genre,
                    'language' => $movie->language,
                    'subtitle' => $movie->subtitle,
                    'country' => $movie->country,
                    'rating' => $movie->rating,
                    'score' => $movie->score,
                    'runtime' => $movie->runtime,
                    'director' => $movie->director,
                    'cast' => $movie->cast,
                    'dateRelease' => $movie->dateRelease,
                    'created' => $movie->created_at,
                    'updated' => $movie->updated_at,
                ];
                array_push($movieArray, $movie);
            }
        // dump($movies);
            
        $walau = [ // movies   // 'movies' => ['movie' (movieArray)
                                                // => [ 1, 2, 3, ... ] ] (movie)
            'movie' => [  // movieArray
                [ // movie
                    '_attributes' => [
                        'id' => 1,
                    ],
                    'ah beng' => 'wow!',
                ], // array_push
                [ // movie
                    '_attributes' => [
                        'id' => 2,
                    ],
                    'ah beng' => 'wow',
                ], // array_push
            ],
        ];
        // dump($walau);
        // return ['movies' => $walau];
        return ['movies' => ['movie' => $movieArray]];

    }

    //XPATH
    public function insertMovie(){
        //show user upload xml file
        return view('xml');
    }

    public function submitInsertMovie(Request $request){
        //decode xml file into array
        $uploaded = $request->file('xml')->get();
        $xml = new \SimpleXMLElement($uploaded);

        //dump($xml);
        $xp = '//movie';
        $movieArray = $xml->xpath($xp);
        //dump($movieArray);
        
        $movie = new Movie();

        if(!empty($movieArray)){
            foreach($movieArray as $value){
                $movie->isVisible = 1;
                $movie->title = $value->title->primary;
                $movie->title2 = $value->title->secondary;
                $movie->description = $value->description->primary;
                $movie->description2 = $value->description->secondary;
                $movie->genre = $value->genre;
                $movie->language = $value->language;
                $movie->subtitle = $value->subtitle;
                $movie->country = $value->country;
                $movie->rating = $value->rating;
                $movie->score = $value->score;
                $movie->runtime = $value->runtime;
                $movie->director = $value->director;
                $movie->cast = $value->cast;
                $movie->dateRelease = $value->dateRelease;
                $movie->created_at = now();
                $movie->updated_at = now();
                $movie->deleted_at = null;
            }
            $movie->save();
            return "Insert Movie Successfully hehe!";
        }
    }
}