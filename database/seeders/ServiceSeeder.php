<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeds the "Our Service Portfolio" content: seven capability areas (A–G).
 * Safe to re-run: services are matched by slug and their bullets are rebuilt.
 *
 * Item format: a plain string = a bullet with no group, or
 * ['Group title' => [bullets...]] for services with sub-sections.
 */
class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            foreach ($this->portfolio() as $index => $data) {
                $service = Service::updateOrCreate(
                    ['slug' => $data['slug']],
                    [
                        'code' => $data['code'],
                        'title' => $data['title'],
                        'description' => $data['description'],
                        'icon' => $data['icon'],
                        'sort_order' => $index + 1,
                        'is_active' => true,
                    ]
                );

                $service->items()->delete();

                $order = 1;
                foreach ($data['groups'] as $groupTitle => $bullets) {
                    foreach ($bullets as $title) {
                        $service->items()->create([
                            'group_title' => is_string($groupTitle) ? $groupTitle : null,
                            'title' => $title,
                            'sort_order' => $order++,
                        ]);
                    }
                }
            }
        });
    }

    private function portfolio(): array
    {
        return [
            [
                'code' => 'A',
                'slug' => 'business-strategy-consulting',
                'title' => 'Business Strategy & Consulting',
                'icon' => 'bi-compass',
                'description' => 'We help leaders decide where to play and how to win. From assessing a new venture to shaping a three-to-five-year plan, we turn market insight and financial logic into strategies that are ambitious and achievable.',
                'groups' => [[
                    'Business strategy development',
                    'Business model design and optimization',
                    'New business and venture assessment',
                    'Market entry strategy',
                    'Market and competitor analysis',
                    'Growth strategy',
                    'Revenue model development',
                    'Pricing strategy',
                    'Cost optimization',
                    'Business case development',
                    'Feasibility studies',
                    'Investment and business opportunity assessment',
                    'Go-to-market strategy',
                    '3–5 year business planning',
                    'Organizational strategy',
                    'Partnership and ecosystem strategy',
                    'Make-or-buy analysis',
                    'Strategic transformation programs',
                ]],
            ],
            [
                'code' => 'B',
                'slug' => 'product-management-digital-products',
                'title' => 'Product Management & Digital Products',
                'icon' => 'bi-box-seam',
                'description' => 'We take products from idea to market and keep them performing. We define the proposition, design the catalog and pricing, and set up the governance and KPIs needed to manage each product across its full lifecycle.',
                'groups' => [[
                    'Product strategy',
                    'Product vision and roadmap',
                    'Product portfolio management',
                    'Product lifecycle management',
                    'Product proposition development',
                    'Product requirements',
                    'Product catalog design',
                    'Pricing and tariff design',
                    'Product launch planning',
                    'Go-to-market',
                    'Product performance management',
                    'Product profitability analysis',
                    'Product optimization',
                    'Digital product management',
                    'Product discovery',
                    'MVP definition',
                    'Feature prioritization',
                    'Product governance',
                    'Product operating model',
                    'Product KPIs and dashboards',
                ]],
            ],
            [
                'code' => 'C',
                'slug' => 'customer-experience-service-design',
                'title' => 'Customer Experience & Service Design',
                'icon' => 'bi-people',
                'description' => 'We design experiences that customers value and organizations can actually deliver. By mapping real journeys and pain points, we redesign every touchpoint, digital and physical, to improve satisfaction, conversion, and loyalty.',
                'groups' => [[
                    'Customer experience strategy',
                    'Customer journey mapping and redesign',
                    'Service blueprinting',
                    'Customer pain-point analysis',
                    'Customer segmentation',
                    'Persona development',
                    'Digital experience design',
                    'Omnichannel experience',
                    'Sales journey optimization',
                    'Onboarding journey',
                    'Retention journey',
                    'Complaint journey',
                    'Self-service strategy',
                    'Customer communication strategy',
                    'Customer experience KPIs',
                    'NPS / CSAT framework',
                    'Customer lifecycle management',
                    'Experience benchmarking',
                ]],
            ],
            [
                'code' => 'D',
                'slug' => 'business-process-operating-model',
                'title' => 'Business Process & Operating Model',
                'icon' => 'bi-diagram-3',
                'description' => 'We help organizations run better. We clarify how work gets done, who owns it, and how it is measured, creating processes and operating models that are simple, controlled, and built to scale.',
                'groups' => [
                    'Process Consulting' => [
                        'As-Is process assessment',
                        'To-Be process design',
                        'Business workflow design',
                        'Process optimization and simplification',
                        'Process automation assessment',
                        'SOP development',
                        'RACI design',
                        'Process governance models',
                        'Approval flows',
                        'Escalation mechanisms',
                        'SLA design',
                        'KPI framework',
                        'Process controls',
                        'Operational performance improvement',
                    ],
                    'Operating Model' => [
                        'Organization structure',
                        'Roles and responsibilities',
                        'Governance model',
                        'Decision-making framework',
                        'Operating model design',
                        'Business/IT interaction model',
                        'Vendor management model',
                        'Partner management model',
                        'Service management model',
                        'Performance management framework',
                    ],
                ],
            ],
            [
                'code' => 'E',
                'slug' => 'technology-technical-consulting',
                'title' => 'Technology & Technical Consulting',
                'icon' => 'bi-cpu',
                'description' => 'We are the bridge between business needs and technical delivery. We translate business requirements into clear technical specifications, assess solutions and vendors, and guide implementation so that technology delivers what the business intended.',
                'groups' => [[
                    'Business-to-technology translation',
                    'IT business requirements',
                    'Solution requirements',
                    'Functional specifications',
                    'System integration assessment',
                    'Digital transformation',
                    'Technology roadmap',
                    'Architecture assessment',
                    'API and integration requirements',
                    'System process mapping',
                    'Technology feasibility assessment',
                    'Vendor evaluation',
                    'Technical solution assessment',
                    'Digital platform strategy',
                    'Automation opportunities',
                    'Technology operating model',
                    'UAT strategy',
                    'Implementation governance',
                    'Technical project management',
                ]],
            ],
            [
                'code' => 'F',
                'slug' => 'data-performance-business-intelligence',
                'title' => 'Data, Performance & Business Intelligence',
                'icon' => 'bi-bar-chart-line',
                'description' => 'We turn data into decisions. We build the KPI frameworks, dashboards, and analytics that give management a clear and reliable view of performance and what to do next.',
                'groups' => [[
                    'KPI framework',
                    'Business performance framework',
                    'Dashboard requirements',
                    'Management dashboards',
                    'Performance reporting',
                    'Data analysis',
                    'Business intelligence',
                    'Sales analytics',
                    'Customer analytics',
                    'Product analytics',
                    'Operational analytics',
                    'Forecasting',
                    'Performance benchmarking',
                    'Data-driven decision frameworks',
                ]],
            ],
            [
                'code' => 'G',
                'slug' => 'transformation-project-delivery',
                'title' => 'Transformation & Project Delivery',
                'icon' => 'bi-rocket-takeoff',
                'description' => "We don't stop at recommendations. Our team stays with you from roadmap to results, managing programs, aligning stakeholders, and tracking benefits until the change is delivered and sustained.",
                'groups' => [[
                    'Transformation strategy',
                    'Transformation roadmap',
                    'Program management',
                    'Project management',
                    'PMO setup',
                    'Project governance',
                    'Implementation management',
                    'Business readiness',
                    'Change management',
                    'Stakeholder management',
                    'Vendor management',
                    'Implementation tracking',
                    'Benefits realization',
                    'Post-launch optimization',
                ]],
            ],
        ];
    }
}
