<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class ValidateHeroSlide
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       
        
        $rules=[


            'title'=>['nullable','string','max:250'],
            'subtitle'=>['nullable','string','max:3000'],
            'image'=>['nullable','image','mimes:jpeg,png,webp,jpg','max:2048']


        ] ;


        $validator=Validator::make($request->all(),$rules);

            if($validator->fails()){


            return response()->json([
                "status"=>"error",
                "message"=>"validation failed",
                "errors"=>$validator->errors()

            ],422);
 



        }




        return $next($request);



    }
}