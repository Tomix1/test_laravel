<?php

namespace App\Dto\Parameters;

use App\Http\Requests\AvailableCarRequest;
use Illuminate\Support\Carbon;

class AvailableCarParameters
{
    public function __construct(
        public Carbon $startedAt,
        public Carbon $finishedAt,
        public ?int   $modelId,
        public ?int   $jobTitleId,
    ) {
    }

    public static function fromRequest(AvailableCarRequest $request): self
    {
        $data = $request->validated();

        return new static(
            startedAt:  Carbon::parse($data['started_at']),
            finishedAt: Carbon::parse($data['finished_at']),
            modelId:    $data['car_model_id'] ?? null,
            jobTitleId: $data['job_title_id'] ?? null,
        );
    }
}
