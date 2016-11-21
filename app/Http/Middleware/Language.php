<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Session;
class Language
{

    public function __construct(Application $app, Redirector $redirector, Request $request)
    {
        $this->app = $app;
        $this->redirector = $redirector;
        $this->request = $request;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Make sure the current local exists
        $locale = $request->segment(1);
        $lang = $this->app->config->get('app.locales');
        if(in_array($locale,array_keys($lang))){
            // If the locale is added to to skip_locales array continue without locale
            if (in_array($locale, $this->app->config->get('app.skip_locales'))) {
                return $next($request);
            } else {
                // If the locale does not exist in the locales array continue with the fallback_locale
                if (! array_key_exists($locale, $this->app->config->get('app.locales'))) {
                    $segments = $request->segments();
                    array_unshift($segments, $this->app->config->get('app.fallback_locale'));
                    // $segments[0] = $this->app->config->get('app.fallback_locale');
                    return $this->redirector->to(implode('/', $segments));
                }
            }

            $lang = $this->getLang($locale);
            $this->app->setLocale($locale);
            Session::put("locate",$locale);
            Session::put("locate_value",$lang->id);
        }else{
            if(Session::has("locate")){
                $locale = Session::get("locate");
                if(in_array($locale,array_keys($lang))){
                    $this->app->setLocale($locale);
                }

            }
        }
        return $next($request);
    }

    public function getLang($locate){
        $lang = \App\Models\Language::where("name",$locate)->get()->first();
        if(empty($lang)){
            throw new \Exception("Invalid locate",500);
        }
        return $lang;
    }

}