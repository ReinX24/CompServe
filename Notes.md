# Notes and Commands

#### Initializing docker container

docker-compose up

Docker Container: localhost:8080

#### TODOS:

#### Freelancer Side

- Freelancer Side Pages
- Freelancer middleware
- Flash message when a new job is made
- Rating system for freelancer

#### Client Side

- Client Side Pages
- Client middleware
- Accept job application from freelancer
- Mark job as complete

#### Admin Side

- Admin middleware

#### Others

- Add separate pages for freelancer and client login and register
- Make arrays into json instead of directly uploading as arrays
- Change job into 2 versions, gig (short term, small job) or contract (long term, big job)
- Client can request freelancer to take a job
- Login and register page errors
- Implement soft deletes and cancelled status instead of outright deleting a record
- Dashboard should compare the statistics from last week to current week
- Make docker also run the laravel application rather than it running separately
- Make a custom guest middleware

#### Alpha Test Requirements (DONE)

[x] System Prototype is deployed and accessible (local server, staging, or hosted).

[x] Project Proposal/Documentation Draft (Problem statement, objectives, methodology).

[x] ERD/Database Schema is finalized and implemented.

[x] Basic Features (core functions of the system) are working.

[x] GitHub Repository is properly set up (public/private with access given to panel).

[x] README File includes installation/setup instructions.

[x] Project Folder Structure is organized.

[x] Coding Best Practices followed (PSR/Laravel/PHP standards, comments, naming).

[x] Version Control Best Practices (meaningful commits, branches if applicable).

[x] Initial Test Cases (basic user test done with screenshots/logs).

#### Functions per user

Admin

- Update and delete job listing X
- Update and delete account information X
- See all registered users (freelancers and clients) X
- Reset the password of users X
- See all reviews X

Freelancer

- Find available job applications X
- Apply and cancel application for job listing X
- See all past and current jobs X
- Reset / forget password X
- Setup freelancer profile X

Client

- Create, update, and delete job listing X
- Accept and reject applicants X
- Reset / forget password X
- Setup client profile X
- Create reviews for each job finished by a freelancer X

# TODO: 12/2/2025

- Manual payment system
- Filtering of reviews
- Soft deletes of user for admin side
