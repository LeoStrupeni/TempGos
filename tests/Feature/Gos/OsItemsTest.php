<?php
namespace Feature\Gos;

use Tests\TestCase;

/**
 * clase para probar items de OS
 *
 * @author yois
 *        
 */
class OsItemsTest extends TestCase
{

    /**
     */
    public function test_actualiza_asesor()
    {
        $response = $this->get(route('osg-actualiza-asesor'));
        $response->assertStatus(200);
    }
}

