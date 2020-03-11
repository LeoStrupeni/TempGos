<?php
namespace App\Http\Controllers\Pruebas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Gos\Gos_Vehiculo_Marca;
use App\Gos\Gos_Cliente;

class PruebaAjaxController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Pruebas/PruebaAjaxYois');
    }

    /**
     *
     * @param Request $request            
     * @return string
     */
    public function datosMarcaVehiculos(Request $request)
    {
        if ($request->ajax()) {
            
            //
        }
        /**
         *
         * @var unknown $vehiculosMarcas
         */
        $vehiculosMarcas = null;
        /**
         *
         * @var string $search
         */
        $search = '';
        //
        // if (! isEmpty($request->get('search'))) {
        
        /**
         *
         * Instrucciones para consultar basado en el search
         *
         * >where('name', 'LIKE', "%{$searchTerm}%")
         * ->orWhere('email', 'LIKE', "%{$searchTerm}%")
         *
         * @var \Illuminate\Database\Eloquent\Collection $vehiculosMarcas
         */
        // $vehiculosMarcas = Gos_Vehiculo_Marca::all()->where('marca_vehiculo', 'LIKE', "%$search%");
        // } else
        
        /**
         *
         * @var Ambigous <\Illuminate\Database\Eloquent\Collection, multitype:\Illuminate\Database\Eloquent\static > $clientesVehiculos
         */
        $vehiculosMarcas = Gos_Vehiculo_Marca::all();
        // Parametros del DataTable
        $draw = 0;
        $recordsTotal = $vehiculosMarcas->count();
        $recordsFiltered = $recordsTotal;
        /**
         *
         * @var string $respuestaJson Donde ira la respuesta Json
         */
        $respuestaJson = '';
        // Armado Json segun Registros
        $respuestaJson = "{
        \"draw\": $draw,
        \"recordsTotal\": $recordsTotal,
        \"recordsFiltered\": $recordsFiltered";
        // Agregar registros
        if ($recordsTotal > 0) {
            $respuestaJson .= ",\"data\": " . $vehiculosMarcas->toJson()/*Se convierte a Json con la funcion toJson de Eloquent*/;
        }
        // Cierra JSon
        $respuestaJson .= "}";
        
        // devolver el json */
        return $respuestaJson;
    }

    public function indexPruebaAjax()
    {
        return view('Pruebas/NuevaPruebaAjax');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     *
     * @param Request $request            
     */

    public function datosAM(){
      // $clientes->gos_cliente::all();
      // return json_enconde($clientes);
      return '{
          "draw": 46,
          "recordsTotal": 57,
          "recordsFiltered": 57,
          "data": [
            {
              "Cliente": "Tiger",
              "Vehiculo": "Nixon",
              "economico": "System Architect",
              "serie": "Edinburgh",
              "Menu": "25th Apr 11"
            },
            {
              "Cliente": "Tiger",
              "Vehiculo": "Nixon",
              "economico": "System Architect",
              "serie": "Edinburgh",
              "Menu": "25th Apr 11"
            }
            ]}';

    }


    public function indexAM(){
      return view('Pruebas/PruebaAjaxAM');
    }



    public function responderGETAjax(Request $request)
    {
        /**
         * LEER EL REQUEST
         * BUSCAR EN LA BASE DE DATOS
         * Y RESPONDER CON JSON
         */
        /**
         *
         * @var string $str
         */
        $str = '{
  "draw": 46,
  "recordsTotal": 57,
  "recordsFiltered": 57,
  "data": [
    {
      "first_name": "Tiger",
      "last_name": "Nixon",
      "position": "System Architect",
      "office": "Edinburgh",
      "start_date": "25th Apr 11",
      "salary": "$320,800"
    },
    {
      "first_name": "Cedric",
      "last_name": "Kelly",
      "position": "Senior Javascript Developer",
      "office": "Edinburgh",
      "start_date": "29th Mar 12",
      "salary": "$433,060"
    },
    {
      "first_name": "Sonya",
      "last_name": "Frost",
      "position": "Software Engineer",
      "office": "Edinburgh",
      "start_date": "13th Dec 08",
      "salary": "$103,600"
    },
    {
      "first_name": "Quinn",
      "last_name": "Flynn",
      "position": "Support Lead",
      "office": "Edinburgh",
      "start_date": "3rd Mar 13",
      "salary": "$342,000"
    },
    {
      "first_name": "Dai",
      "last_name": "Rios",
      "position": "Personnel Lead",
      "office": "Edinburgh",
      "start_date": "26th Sep 12",
      "salary": "$217,500"
    },
    {
      "first_name": "Gavin",
      "last_name": "Joyce",
      "position": "Developer",
      "office": "Edinburgh",
      "start_date": "22nd Dec 10",
      "salary": "$92,575"
    },
    {
      "first_name": "Martena",
      "last_name": "Mccray",
      "position": "Post-Sales support",
      "office": "Edinburgh",
      "start_date": "9th Mar 11",
      "salary": "$324,050"
    },
    {
      "first_name": "Jennifer",
      "last_name": "Acosta",
      "position": "Junior Javascript Developer",
      "office": "Edinburgh",
      "start_date": "1st Feb 13",
      "salary": "$75,650"
    },
    {
      "first_name": "Shad",
      "last_name": "Decker",
      "position": "Regional Director",
      "office": "Edinburgh",
      "start_date": "13th Nov 08",
      "salary": "$183,000"
    },
    {
      "first_name": "Jena",
      "last_name": "Gaines",
      "position": "Office Manager",
      "office": "London",
      "start_date": "19th Dec 08",
      "salary": "$90,560"
    },
    {
      "first_name": "Haley",
      "last_name": "Kennedy",
      "position": "Senior Marketing Designer",
      "office": "London",
      "start_date": "18th Dec 12",
      "salary": "$313,500"
    },
    {
      "first_name": "Tatyana",
      "last_name": "Fitzpatrick",
      "position": "Regional Director",
      "office": "London",
      "start_date": "17th Mar 10",
      "salary": "$385,750"
    },
    {
      "first_name": "Michael",
      "last_name": "Silva",
      "position": "Marketing Designer",
      "office": "London",
      "start_date": "27th Nov 12",
      "salary": "$198,500"
    },
    {
      "first_name": "Bradley",
      "last_name": "Greer",
      "position": "Software Engineer",
      "office": "London",
      "start_date": "13th Oct 12",
      "salary": "$132,000"
    },
    {
      "first_name": "Angelica",
      "last_name": "Ramos",
      "position": "Chief Executive Officer (CEO)",
      "office": "London",
      "start_date": "9th Oct 09",
      "salary": "$1,200,000"
    },
    {
      "first_name": "Suki",
      "last_name": "Burks",
      "position": "Developer",
      "office": "London",
      "start_date": "22nd Oct 09",
      "salary": "$114,500"
    },
    {
      "first_name": "Prescott",
      "last_name": "Bartlett",
      "position": "Technical Author",
      "office": "London",
      "start_date": "7th May 11",
      "salary": "$145,000"
    },
    {
      "first_name": "Timothy",
      "last_name": "Mooney",
      "position": "Office Manager",
      "office": "London",
      "start_date": "11th Dec 08",
      "salary": "$136,200"
    },
    {
      "first_name": "Bruno",
      "last_name": "Nash",
      "position": "Software Engineer",
      "office": "London",
      "start_date": "3rd May 11",
      "salary": "$163,500"
    },
    {
      "first_name": "Hermione",
      "last_name": "Butler",
      "position": "Regional Director",
      "office": "London",
      "start_date": "21st Mar 11",
      "salary": "$356,250"
    },
    {
      "first_name": "Lael",
      "last_name": "Greer",
      "position": "Systems Administrator",
      "office": "London",
      "start_date": "27th Feb 09",
      "salary": "$103,500"
    },
    {
      "first_name": "Brielle",
      "last_name": "Williamson",
      "position": "Integration Specialist",
      "office": "New York",
      "start_date": "2nd Dec 12",
      "salary": "$372,000"
    },
    {
      "first_name": "Paul",
      "last_name": "Byrd",
      "position": "Chief Financial Officer (CFO)",
      "office": "New York",
      "start_date": "9th Jun 10",
      "salary": "$725,000"
    },
    {
      "first_name": "Gloria",
      "last_name": "Little",
      "position": "Systems Administrator",
      "office": "New York",
      "start_date": "10th Apr 09",
      "salary": "$237,500"
    },
    {
      "first_name": "Jenette",
      "last_name": "Caldwell",
      "position": "Development Lead",
      "office": "New York",
      "start_date": "3rd Sep 11",
      "salary": "$345,000"
    },
    {
      "first_name": "Yuri",
      "last_name": "Berry",
      "position": "Chief Marketing Officer (CMO)",
      "office": "New York",
      "start_date": "25th Jun 09",
      "salary": "$675,000"
    },
    {
      "first_name": "Caesar",
      "last_name": "Vance",
      "position": "Pre-Sales Support",
      "office": "New York",
      "start_date": "12th Dec 11",
      "salary": "$106,450"
    },
    {
      "first_name": "Jackson",
      "last_name": "Bradshaw",
      "position": "Director",
      "office": "New York",
      "start_date": "26th Sep 08",
      "salary": "$645,750"
    },
    {
      "first_name": "Thor",
      "last_name": "Walton",
      "position": "Developer",
      "office": "New York",
      "start_date": "11th Aug 13",
      "salary": "$98,540"
    },
    {
      "first_name": "Zenaida",
      "last_name": "Frank",
      "position": "Software Engineer",
      "office": "New York",
      "start_date": "4th Jan 10",
      "salary": "$125,250"
    },
    {
      "first_name": "Cara",
      "last_name": "Stevens",
      "position": "Sales Assistant",
      "office": "New York",
      "start_date": "6th Dec 11",
      "salary": "$145,600"
    },
    {
      "first_name": "Donna",
      "last_name": "Snider",
      "position": "Customer Support",
      "office": "New York",
      "start_date": "25th Jan 11",
      "salary": "$112,000"
    },
    {
      "first_name": "Ashton",
      "last_name": "Cox",
      "position": "Junior Technical Author",
      "office": "San Francisco",
      "start_date": "12th Jan 09",
      "salary": "$86,000"
    },
    {
      "first_name": "Herrod",
      "last_name": "Chandler",
      "position": "Sales Assistant",
      "office": "San Francisco",
      "start_date": "6th Aug 12",
      "salary": "$137,500"
    },
    {
      "first_name": "Colleen",
      "last_name": "Hurst",
      "position": "Javascript Developer",
      "office": "San Francisco",
      "start_date": "15th Sep 09",
      "salary": "$205,500"
    },
    {
      "first_name": "Charde",
      "last_name": "Marshall",
      "position": "Regional Director",
      "office": "San Francisco",
      "start_date": "16th Oct 08",
      "salary": "$470,600"
    },
    {
      "first_name": "Brenden",
      "last_name": "Wagner",
      "position": "Software Engineer",
      "office": "San Francisco",
      "start_date": "7th Jun 11",
      "salary": "$206,850"
    },
    {
      "first_name": "Fiona",
      "last_name": "Green",
      "position": "Chief Operating Officer (COO)",
      "office": "San Francisco",
      "start_date": "11th Mar 10",
      "salary": "$850,000"
    },
    {
      "first_name": "Gavin",
      "last_name": "Cortez",
      "position": "Team Leader",
      "office": "San Francisco",
      "start_date": "26th Oct 08",
      "salary": "$235,500"
    },
    {
      "first_name": "Unity",
      "last_name": "Butler",
      "position": "Marketing Designer",
      "office": "San Francisco",
      "start_date": "9th Dec 09",
      "salary": "$85,675"
    },
    {
      "first_name": "Howard",
      "last_name": "Hatfield",
      "position": "Office Manager",
      "office": "San Francisco",
      "start_date": "16th Dec 08",
      "salary": "$164,500"
    },
    {
      "first_name": "Hope",
      "last_name": "Fuentes",
      "position": "Secretary",
      "office": "San Francisco",
      "start_date": "12th Feb 10",
      "salary": "$109,850"
    },
    {
      "first_name": "Vivian",
      "last_name": "Harrell",
      "position": "Financial Controller",
      "office": "San Francisco",
      "start_date": "14th Feb 09",
      "salary": "$452,500"
    },
    {
      "first_name": "Finn",
      "last_name": "Camacho",
      "position": "Support Engineer",
      "office": "San Francisco",
      "start_date": "7th Jul 09",
      "salary": "$87,500"
    },
    {
      "first_name": "Zorita",
      "last_name": "Serrano",
      "position": "Software Engineer",
      "office": "San Francisco",
      "start_date": "1st Jun 12",
      "salary": "$115,000"
    },
    {
      "first_name": "Jonas",
      "last_name": "Alexander",
      "position": "Developer",
      "office": "San Francisco",
      "start_date": "14th Jul 10",
      "salary": "$86,500"
    },
    {
      "first_name": "Doris",
      "last_name": "Wilder",
      "position": "Sales Assistant",
      "office": "Sidney",
      "start_date": "20th Sep 10",
      "salary": "$85,600"
    },
    {
      "first_name": "Michelle",
      "last_name": "House",
      "position": "Integration Specialist",
      "office": "Sidney",
      "start_date": "2nd Jun 11",
      "salary": "$95,400"
    },
    {
      "first_name": "Jennifer",
      "last_name": "Chang",
      "position": "Regional Director",
      "office": "Singapore",
      "start_date": "14th Nov 10",
      "salary": "$357,650"
    },
    {
      "first_name": "Olivia",
      "last_name": "Liang",
      "position": "Support Engineer",
      "office": "Singapore",
      "start_date": "3rd Feb 11",
      "salary": "$234,500"
    },
    {
      "first_name": "Serge",
      "last_name": "Baldwin",
      "position": "Data Coordinator",
      "office": "Singapore",
      "start_date": "9th Apr 12",
      "salary": "$138,575"
    },
    {
      "first_name": "Michael",
      "last_name": "Bruce",
      "position": "Javascript Developer",
      "office": "Singapore",
      "start_date": "27th Jun 11",
      "salary": "$183,000"
    },
    {
      "first_name": "Garrett",
      "last_name": "Winters",
      "position": "Accountant",
      "office": "Tokyo",
      "start_date": "25th Jul 11",
      "salary": "$170,750"
    },
    {
      "first_name": "Airi",
      "last_name": "Satou",
      "position": "Accountant",
      "office": "Tokyo",
      "start_date": "28th Nov 08",
      "salary": "$162,700"
    },
    {
      "first_name": "Rhona",
      "last_name": "Davidson",
      "position": "Integration Specialist",
      "office": "Tokyo",
      "start_date": "14th Oct 10",
      "salary": "$327,900"
    },
    {
      "first_name": "Shou",
      "last_name": "Itou",
      "position": "Regional Marketing",
      "office": "Tokyo",
      "start_date": "14th Aug 11",
      "salary": "$163,000"
    },
    {
      "first_name": "Sakura",
      "last_name": "Yamamoto",
      "position": "Support Engineer",
      "office": "Tokyo",
      "start_date": "19th Aug 09",
      "salary": "$139,575"
    }
  ]
}';
        echo $str;
    }

    /**
     *
     * @param Request $request            
     */
    public function responderPOSTAjax(Request $request)
    {
        /**
         * RECIBIR POST DE DATOS
         * GURDAR EN BASE DE DATOS
         * Y RESPONDER CON JSON
         */
        echo 'RESPUESTA JSON';
    }

    /**
     * Display the specified resource.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     *
     * @param Request $request            
     */
    public function getEnzoAjax(Request $request)
    {
    /**
     * {
     * "first_name": "Sakura",
     * "last_name": "Yamamoto",
     * "position": "Support Engineer",
     * "office": "Tokyo",
     * "start_date": "19th Aug 09",
     * "salary": "$139,575"
     * }
     */
        // escribo mi codigo de JSON
    }

    /**
     *
     * @param Request $request            
     */
    public function postEnzoAjax(Request $request)
    {
    /**
     * {
     * "first_name": "Sakura",
     * "last_name": "Yamamoto",
     * "position": "Support Engineer",
     * "office": "Tokyo",
     * "start_date": "19th Aug 09",
     * "salary": "$139,575"
     * }
     */
        // escribo mi codigo de JSON
    }

    // public function index()
    // {
    // return view('Pruebas/PruebaAjaxYois');
    // }
    public function pruebagetam(Request $request)
    {
        return view('Pruebas/PruebaAjaxAM');
    }

    public function pruebapostam()
    {}
}
