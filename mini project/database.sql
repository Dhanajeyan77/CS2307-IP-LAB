DROP DATABASE IF EXISTS job_portal;
CREATE DATABASE job_portal;
USE job_portal;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('seeker', 'recruiter') NOT NULL DEFAULT 'seeker'
);

CREATE TABLE jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    recruiter_id INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    company VARCHAR(100) NOT NULL,
    location VARCHAR(100) NOT NULL,
    salary VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (recruiter_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    job_id INT NOT NULL,
    applicant_name VARCHAR(100) NOT NULL,
    applicant_email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    domain VARCHAR(100) NOT NULL,
    experience VARCHAR(50) NOT NULL,
    education VARCHAR(150) NOT NULL,
    cover_letter TEXT NOT NULL,
    resume_path VARCHAR(255) NOT NULL,
    applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (job_id) REFERENCES jobs(id) ON DELETE CASCADE
);

INSERT INTO users (name, email, password, role) VALUES 
('HR Manager', 'hr@techcorp.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'recruiter'), 
('John Seeker', 'seeker@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'seeker');

INSERT INTO jobs (recruiter_id, title, company, location, salary, description) VALUES 
(1, 'Software Engineer', 'Tech Innovators', 'Bangalore, India', '₹12,00,000/yr', 'Develop scalable web applications.'),
(1, 'Data Analyst', 'DataCorp', 'Pune, India', '₹8,50,000/yr', 'Analyze large datasets.'),
(1, 'Frontend Developer', 'Creative Solutions', 'Chennai, India', '₹6,00,000/yr', 'Build responsive UIs.');
