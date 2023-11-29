<?php

namespace Arcplg\Smaregi\Tests;

use Arcplg\Smaregi\Smaregi;


class AuthorizationTest extends TestCase
{


    /** @test 
     * test the autorization sccess token
     * @return mixed
     */
    public function testAuthorizationTokenType()
    {
        $smaregi = new Smaregi();
        $loginDetails = $smaregi->login();
        return $this->assertEquals(config('smaregi.smaregi_auth_token_type'), $loginDetails->token_type . ' ');

    }
    /** @test 
     * test the success authorization code
     * @return mixed
     */
    public function testAuthorizationSuccessCode()
    {
        $smaregi = new Smaregi();
        $loginDetails = $smaregi->login();

        return $this->assertEquals(200, $loginDetails->status_code);

    }

    /** @test 
     * test for the code authorization scope failure
     * @return mixed
     */
    public function testAuthorizationFailureOnScope()
    {
        $smaregi = new Smaregi(11);
        $loginDetails = $smaregi->login();
        return $this->assertEquals(400, $loginDetails->status_code);

    }

    /** @test 
     * test for the authorization scope success
     * @return mixed
     */
    public function testAuthorizationSuccessOnScope()
    {
        $smaregi = new Smaregi(['pos.products:read', 'pos.products:write']);
        $loginDetails = $smaregi->login();
        $loginScope = $loginDetails->scope;
        return $this->assertEquals(config('smaregi.smaregi_access')[0] . ' ' . config('smaregi.smaregi_access')[1], $loginScope);
    }

    /** @test 
     * test for the default authorization scope
     * @return mixed
     */
    public function testAuthorizationDefaultScope()
    {
        $smaregi = new Smaregi();
        $loginDetails = $smaregi->login();
        $loginScope = $loginDetails->scope;
        $loginScopeArray = explode(' ', $loginScope);
        $result = true;
        $test = 1;
        foreach ($loginScopeArray as $scope) {
            if ($result == true) {
                if (in_array($scope, config('smaregi.smaregi_access'))) {
                    $result = true;
                } else {
                    $result = false;
                }
            } else {
                continue;
            }
            $test++;

        }
        return $this->assertTrue($result);
    }
}
