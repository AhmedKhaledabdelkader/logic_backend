<?php

namespace Database\Seeders;

use App\Models\WorkStep;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeds the "How We Work" seven-step approach.
 * Safe to re-run: steps are matched by title and re-ordered.
 */
class WorkStepSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            foreach ($this->steps() as $index => $step) {
                WorkStep::updateOrCreate(
                    ['title' => $step['title']],
                    $step + ['sort_order' => $index + 1, 'is_active' => true]
                );
            }
        });
    }

    private function steps(): array
    {
        return [
            [
                'title' => 'Understand',
                'icon' => 'bi-search',
                'description' => "We start by understanding the client's business, objectives, challenges, customers, existing processes, technology environment, and key stakeholders.",
                'outcome' => 'Clear understanding of the business problem and objectives.',
            ],
            [
                'title' => 'Diagnose',
                'icon' => 'bi-clipboard2-pulse',
                'description' => 'We analyze the current situation and identify gaps, pain points, inefficiencies, risks, and root causes. We do not focus only on the symptoms; we focus on why the problem exists.',
                'outcome' => 'Current-state assessment and a clearly defined problem statement.',
            ],
            [
                'title' => 'Design',
                'icon' => 'bi-vector-pen',
                'description' => 'We develop practical solutions based on business requirements, customer needs, operational capabilities, and technology possibilities. Depending on the engagement, this may include a business model, product strategy, customer journey, operating model, process flows, technology requirements, financial model, or KPI framework.',
                'outcome' => 'Future-state solution and target operating model.',
            ],
            [
                'title' => 'Validate',
                'icon' => 'bi-patch-check',
                'description' => 'We work with key stakeholders to validate the proposed solution from business, operational, financial, customer, and technical perspectives.',
                'outcome' => 'Agreed solution and prioritized recommendations.',
            ],
            [
                'title' => 'Plan',
                'icon' => 'bi-signpost-split',
                'description' => 'We translate the solution into an executable roadmap that sets out priorities, dependencies, resources, timelines, responsibilities, KPIs, and expected benefits.',
                'outcome' => 'Clear implementation roadmap.',
            ],
            [
                'title' => 'Implement',
                'icon' => 'bi-rocket-takeoff',
                'description' => 'Where required, our team stays involved beyond the strategy stage and supports implementation, project management, testing, launch, and stakeholder alignment.',
                'outcome' => 'An implemented solution, not a presentation-only recommendation.',
            ],
            [
                'title' => 'Measure & Optimize',
                'icon' => 'bi-graph-up-arrow',
                'description' => 'After implementation, we measure results against agreed KPIs and identify further opportunities for optimization.',
                'outcome' => 'Measurable business impact and continuous improvement.',
            ],
        ];
    }
}
