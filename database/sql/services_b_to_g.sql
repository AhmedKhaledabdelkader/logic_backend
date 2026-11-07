-- Services B-G (Our Service Portfolio). Safe to re-run: services are matched by slug,
-- and their bullet points are rebuilt. Requires the `services` and `service_items` tables.

SET NAMES utf8mb4;
START TRANSACTION;

-- ===== B. Product Management & Digital Products =====
INSERT INTO services (code, slug, title, description, icon, sort_order, is_active, created_at, updated_at)
VALUES ('B', 'product-management-digital-products', 'Product Management & Digital Products',
  'We take products from idea to market and keep them performing. We define the proposition, design the catalog and pricing, and set up the governance and KPIs needed to manage each product across its full lifecycle.',
  'bi-box-seam', 2, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE code = VALUES(code), title = VALUES(title), description = VALUES(description),
  icon = VALUES(icon), sort_order = VALUES(sort_order), is_active = 1, updated_at = NOW();

SET @sid := (SELECT id FROM services WHERE slug = 'product-management-digital-products');
DELETE FROM service_items WHERE service_id = @sid;
INSERT INTO service_items (service_id, group_title, title, sort_order, created_at, updated_at) VALUES
  (@sid, NULL, 'Product strategy', 1, NOW(), NOW()),
  (@sid, NULL, 'Product vision and roadmap', 2, NOW(), NOW()),
  (@sid, NULL, 'Product portfolio management', 3, NOW(), NOW()),
  (@sid, NULL, 'Product lifecycle management', 4, NOW(), NOW()),
  (@sid, NULL, 'Product proposition development', 5, NOW(), NOW()),
  (@sid, NULL, 'Product requirements', 6, NOW(), NOW()),
  (@sid, NULL, 'Product catalog design', 7, NOW(), NOW()),
  (@sid, NULL, 'Pricing and tariff design', 8, NOW(), NOW()),
  (@sid, NULL, 'Product launch planning', 9, NOW(), NOW()),
  (@sid, NULL, 'Go-to-market', 10, NOW(), NOW()),
  (@sid, NULL, 'Product performance management', 11, NOW(), NOW()),
  (@sid, NULL, 'Product profitability analysis', 12, NOW(), NOW()),
  (@sid, NULL, 'Product optimization', 13, NOW(), NOW()),
  (@sid, NULL, 'Digital product management', 14, NOW(), NOW()),
  (@sid, NULL, 'Product discovery', 15, NOW(), NOW()),
  (@sid, NULL, 'MVP definition', 16, NOW(), NOW()),
  (@sid, NULL, 'Feature prioritization', 17, NOW(), NOW()),
  (@sid, NULL, 'Product governance', 18, NOW(), NOW()),
  (@sid, NULL, 'Product operating model', 19, NOW(), NOW()),
  (@sid, NULL, 'Product KPIs and dashboards', 20, NOW(), NOW());

-- ===== C. Customer Experience & Service Design =====
INSERT INTO services (code, slug, title, description, icon, sort_order, is_active, created_at, updated_at)
VALUES ('C', 'customer-experience-service-design', 'Customer Experience & Service Design',
  'We design experiences that customers value and organizations can actually deliver. By mapping real journeys and pain points, we redesign every touchpoint, digital and physical, to improve satisfaction, conversion, and loyalty.',
  'bi-people', 3, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE code = VALUES(code), title = VALUES(title), description = VALUES(description),
  icon = VALUES(icon), sort_order = VALUES(sort_order), is_active = 1, updated_at = NOW();

SET @sid := (SELECT id FROM services WHERE slug = 'customer-experience-service-design');
DELETE FROM service_items WHERE service_id = @sid;
INSERT INTO service_items (service_id, group_title, title, sort_order, created_at, updated_at) VALUES
  (@sid, NULL, 'Customer experience strategy', 1, NOW(), NOW()),
  (@sid, NULL, 'Customer journey mapping and redesign', 2, NOW(), NOW()),
  (@sid, NULL, 'Service blueprinting', 3, NOW(), NOW()),
  (@sid, NULL, 'Customer pain-point analysis', 4, NOW(), NOW()),
  (@sid, NULL, 'Customer segmentation', 5, NOW(), NOW()),
  (@sid, NULL, 'Persona development', 6, NOW(), NOW()),
  (@sid, NULL, 'Digital experience design', 7, NOW(), NOW()),
  (@sid, NULL, 'Omnichannel experience', 8, NOW(), NOW()),
  (@sid, NULL, 'Sales journey optimization', 9, NOW(), NOW()),
  (@sid, NULL, 'Onboarding journey', 10, NOW(), NOW()),
  (@sid, NULL, 'Retention journey', 11, NOW(), NOW()),
  (@sid, NULL, 'Complaint journey', 12, NOW(), NOW()),
  (@sid, NULL, 'Self-service strategy', 13, NOW(), NOW()),
  (@sid, NULL, 'Customer communication strategy', 14, NOW(), NOW()),
  (@sid, NULL, 'Customer experience KPIs', 15, NOW(), NOW()),
  (@sid, NULL, 'NPS / CSAT framework', 16, NOW(), NOW()),
  (@sid, NULL, 'Customer lifecycle management', 17, NOW(), NOW()),
  (@sid, NULL, 'Experience benchmarking', 18, NOW(), NOW());

-- ===== D. Business Process & Operating Model =====
INSERT INTO services (code, slug, title, description, icon, sort_order, is_active, created_at, updated_at)
VALUES ('D', 'business-process-operating-model', 'Business Process & Operating Model',
  'We help organizations run better. We clarify how work gets done, who owns it, and how it is measured, creating processes and operating models that are simple, controlled, and built to scale.',
  'bi-diagram-3', 4, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE code = VALUES(code), title = VALUES(title), description = VALUES(description),
  icon = VALUES(icon), sort_order = VALUES(sort_order), is_active = 1, updated_at = NOW();

SET @sid := (SELECT id FROM services WHERE slug = 'business-process-operating-model');
DELETE FROM service_items WHERE service_id = @sid;
INSERT INTO service_items (service_id, group_title, title, sort_order, created_at, updated_at) VALUES
  (@sid, 'Process Consulting', 'As-Is process assessment', 1, NOW(), NOW()),
  (@sid, 'Process Consulting', 'To-Be process design', 2, NOW(), NOW()),
  (@sid, 'Process Consulting', 'Business workflow design', 3, NOW(), NOW()),
  (@sid, 'Process Consulting', 'Process optimization and simplification', 4, NOW(), NOW()),
  (@sid, 'Process Consulting', 'Process automation assessment', 5, NOW(), NOW()),
  (@sid, 'Process Consulting', 'SOP development', 6, NOW(), NOW()),
  (@sid, 'Process Consulting', 'RACI design', 7, NOW(), NOW()),
  (@sid, 'Process Consulting', 'Process governance models', 8, NOW(), NOW()),
  (@sid, 'Process Consulting', 'Approval flows', 9, NOW(), NOW()),
  (@sid, 'Process Consulting', 'Escalation mechanisms', 10, NOW(), NOW()),
  (@sid, 'Process Consulting', 'SLA design', 11, NOW(), NOW()),
  (@sid, 'Process Consulting', 'KPI framework', 12, NOW(), NOW()),
  (@sid, 'Process Consulting', 'Process controls', 13, NOW(), NOW()),
  (@sid, 'Process Consulting', 'Operational performance improvement', 14, NOW(), NOW()),
  (@sid, 'Operating Model', 'Organization structure', 15, NOW(), NOW()),
  (@sid, 'Operating Model', 'Roles and responsibilities', 16, NOW(), NOW()),
  (@sid, 'Operating Model', 'Governance model', 17, NOW(), NOW()),
  (@sid, 'Operating Model', 'Decision-making framework', 18, NOW(), NOW()),
  (@sid, 'Operating Model', 'Operating model design', 19, NOW(), NOW()),
  (@sid, 'Operating Model', 'Business/IT interaction model', 20, NOW(), NOW()),
  (@sid, 'Operating Model', 'Vendor management model', 21, NOW(), NOW()),
  (@sid, 'Operating Model', 'Partner management model', 22, NOW(), NOW()),
  (@sid, 'Operating Model', 'Service management model', 23, NOW(), NOW()),
  (@sid, 'Operating Model', 'Performance management framework', 24, NOW(), NOW());

-- ===== E. Technology & Technical Consulting =====
INSERT INTO services (code, slug, title, description, icon, sort_order, is_active, created_at, updated_at)
VALUES ('E', 'technology-technical-consulting', 'Technology & Technical Consulting',
  'We are the bridge between business needs and technical delivery. We translate business requirements into clear technical specifications, assess solutions and vendors, and guide implementation so that technology delivers what the business intended.',
  'bi-cpu', 5, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE code = VALUES(code), title = VALUES(title), description = VALUES(description),
  icon = VALUES(icon), sort_order = VALUES(sort_order), is_active = 1, updated_at = NOW();

SET @sid := (SELECT id FROM services WHERE slug = 'technology-technical-consulting');
DELETE FROM service_items WHERE service_id = @sid;
INSERT INTO service_items (service_id, group_title, title, sort_order, created_at, updated_at) VALUES
  (@sid, NULL, 'Business-to-technology translation', 1, NOW(), NOW()),
  (@sid, NULL, 'IT business requirements', 2, NOW(), NOW()),
  (@sid, NULL, 'Solution requirements', 3, NOW(), NOW()),
  (@sid, NULL, 'Functional specifications', 4, NOW(), NOW()),
  (@sid, NULL, 'System integration assessment', 5, NOW(), NOW()),
  (@sid, NULL, 'Digital transformation', 6, NOW(), NOW()),
  (@sid, NULL, 'Technology roadmap', 7, NOW(), NOW()),
  (@sid, NULL, 'Architecture assessment', 8, NOW(), NOW()),
  (@sid, NULL, 'API and integration requirements', 9, NOW(), NOW()),
  (@sid, NULL, 'System process mapping', 10, NOW(), NOW()),
  (@sid, NULL, 'Technology feasibility assessment', 11, NOW(), NOW()),
  (@sid, NULL, 'Vendor evaluation', 12, NOW(), NOW()),
  (@sid, NULL, 'Technical solution assessment', 13, NOW(), NOW()),
  (@sid, NULL, 'Digital platform strategy', 14, NOW(), NOW()),
  (@sid, NULL, 'Automation opportunities', 15, NOW(), NOW()),
  (@sid, NULL, 'Technology operating model', 16, NOW(), NOW()),
  (@sid, NULL, 'UAT strategy', 17, NOW(), NOW()),
  (@sid, NULL, 'Implementation governance', 18, NOW(), NOW()),
  (@sid, NULL, 'Technical project management', 19, NOW(), NOW());

-- ===== F. Data, Performance & Business Intelligence =====
INSERT INTO services (code, slug, title, description, icon, sort_order, is_active, created_at, updated_at)
VALUES ('F', 'data-performance-business-intelligence', 'Data, Performance & Business Intelligence',
  'We turn data into decisions. We build the KPI frameworks, dashboards, and analytics that give management a clear and reliable view of performance and what to do next.',
  'bi-bar-chart-line', 6, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE code = VALUES(code), title = VALUES(title), description = VALUES(description),
  icon = VALUES(icon), sort_order = VALUES(sort_order), is_active = 1, updated_at = NOW();

SET @sid := (SELECT id FROM services WHERE slug = 'data-performance-business-intelligence');
DELETE FROM service_items WHERE service_id = @sid;
INSERT INTO service_items (service_id, group_title, title, sort_order, created_at, updated_at) VALUES
  (@sid, NULL, 'KPI framework', 1, NOW(), NOW()),
  (@sid, NULL, 'Business performance framework', 2, NOW(), NOW()),
  (@sid, NULL, 'Dashboard requirements', 3, NOW(), NOW()),
  (@sid, NULL, 'Management dashboards', 4, NOW(), NOW()),
  (@sid, NULL, 'Performance reporting', 5, NOW(), NOW()),
  (@sid, NULL, 'Data analysis', 6, NOW(), NOW()),
  (@sid, NULL, 'Business intelligence', 7, NOW(), NOW()),
  (@sid, NULL, 'Sales analytics', 8, NOW(), NOW()),
  (@sid, NULL, 'Customer analytics', 9, NOW(), NOW()),
  (@sid, NULL, 'Product analytics', 10, NOW(), NOW()),
  (@sid, NULL, 'Operational analytics', 11, NOW(), NOW()),
  (@sid, NULL, 'Forecasting', 12, NOW(), NOW()),
  (@sid, NULL, 'Performance benchmarking', 13, NOW(), NOW()),
  (@sid, NULL, 'Data-driven decision frameworks', 14, NOW(), NOW());

-- ===== G. Transformation & Project Delivery =====
INSERT INTO services (code, slug, title, description, icon, sort_order, is_active, created_at, updated_at)
VALUES ('G', 'transformation-project-delivery', 'Transformation & Project Delivery',
  'We don''t stop at recommendations. Our team stays with you from roadmap to results, managing programs, aligning stakeholders, and tracking benefits until the change is delivered and sustained.',
  'bi-rocket-takeoff', 7, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE code = VALUES(code), title = VALUES(title), description = VALUES(description),
  icon = VALUES(icon), sort_order = VALUES(sort_order), is_active = 1, updated_at = NOW();

SET @sid := (SELECT id FROM services WHERE slug = 'transformation-project-delivery');
DELETE FROM service_items WHERE service_id = @sid;
INSERT INTO service_items (service_id, group_title, title, sort_order, created_at, updated_at) VALUES
  (@sid, NULL, 'Transformation strategy', 1, NOW(), NOW()),
  (@sid, NULL, 'Transformation roadmap', 2, NOW(), NOW()),
  (@sid, NULL, 'Program management', 3, NOW(), NOW()),
  (@sid, NULL, 'Project management', 4, NOW(), NOW()),
  (@sid, NULL, 'PMO setup', 5, NOW(), NOW()),
  (@sid, NULL, 'Project governance', 6, NOW(), NOW()),
  (@sid, NULL, 'Implementation management', 7, NOW(), NOW()),
  (@sid, NULL, 'Business readiness', 8, NOW(), NOW()),
  (@sid, NULL, 'Change management', 9, NOW(), NOW()),
  (@sid, NULL, 'Stakeholder management', 10, NOW(), NOW()),
  (@sid, NULL, 'Vendor management', 11, NOW(), NOW()),
  (@sid, NULL, 'Implementation tracking', 12, NOW(), NOW()),
  (@sid, NULL, 'Benefits realization', 13, NOW(), NOW()),
  (@sid, NULL, 'Post-launch optimization', 14, NOW(), NOW());

COMMIT;
