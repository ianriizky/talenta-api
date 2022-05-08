<?php

namespace Ianriizky\TalentaApi\Services\Api;

use Illuminate\Http\Client\Response;

/**
 * @property \Ianriizky\TalentaApi\Http\Client\PendingRequest $request
 *
 * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#630f960f-aeee-43d6-876d-765f41ab6a52
 */
trait Fingerprint
{
    /**
     * Create "/attendance/import-fingerprint" POST request to the Talenta api.
     *
     * Submit Attendance Import Fingerprint.
     *
     * @param  array  $data
     * @param  array<string|resource>  $files
     * @return \Illuminate\Http\Client\Response
     *
     * @see https://documenter.getpostman.com/view/12246328/TWDZHvj1#6493f000-0157-42a5-af73-eb40cf9bb4cd
     */
    protected function postAttendanceImportFingerprint(array $data = [], array $files): Response
    {
        return $this->request
            ->attach($files)
            ->post('/attendance/import-fingerprint', $data);
    }
}
