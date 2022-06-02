<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/devices_list_by_type','/interventions_list','/inreg_interventions','/get_interventions','/download_interv_report','/generate_interv_excell_report','/gener_excell_rep_filter','/add_intervention','/mini_calibaration_list_view','/machine_count','/get_shuts','/get_mini_shuts',
    ];
}
