<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Carbon\Carbon;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($this->isHttpException($e))
        {           
            $error = [];                
            $error['code'] = $e->getStatusCode();
            $error['date'] = Carbon::now();
                     
            switch ($error['code']) {
                case '400':
                    $error['msg'] = "La URL a la que se intenta acceder tiene un formato/sintaxis no valido";
                    break;
                case '401':
                    $error['msg'] = "No tienes Permisos suficientes para esta acción, Consulte a su Superior";
                    break;
                case '403':
                    $error['msg'] = "Acceso Denegado";
                    break; 
                case '404':
                    $error['msg'] = "Pagina no encontrada.";
                    break;
                case '406':
                    $error['msg'] = "Su navegador web  requiere actualizaciones para mostrar este contenido.";
                    break;
                case '500':
                    $error['msg'] = "Se ha encontrado un error, por favor envie una captura de esta pantalla al departamento de Sistemas";
                    break;
                case '504':
                    $error['msg'] = "El tiempo de espera para esta petición se ha agotado, Verifique su conexion a internet";
                    break;
                case '509':
                    $error['msg'] = "Se ha superado el límite de ancho de banda disponible, Contacte a su Hosting";
                    break;                               
                default:
                    $error['msg'] = "Ha ocurrido un error, por favor envie una captura de esta pantalla al departamento de Sistemas";
                    break;
            }

            return response()->view('errors.error_all', ['code' =>  $error['code'], 'msg' => $error['msg'], 'date' => $error['date']], 404);
            
           
        }


        if ($e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException($e->getMessage(), $e);
        }
   
        if ($e instanceof TokenMismatchException) {  //mensaje de error en caso de mistake token
            //return redirect(route('token.error'))->with('message', 'You page session expired. Please try again');
            return redirect(route('token.error'));
        }
         
        //debugger lines        
        if (config('app.debug')){  return $this->renderExceptionWithWhoops($e);} 
          
        

        return parent::render($request, $e);  //ORIGINAL
    }

//para el debbuger 
     protected function renderExceptionWithWhoops(Exception $e)
    {
        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());

        return new \Illuminate\Http\Response(
            $whoops->handleException($e),
            $e->getStatusCode(),
            $e->getHeaders()
        );
    }
}
