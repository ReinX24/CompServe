# CompServe

#### Flowchart

```
[User Browser / Client App]
    |
    |-- Access “Home / Landing / Login / Register”
    |-- Authenticates → Login / Register Controller
    |
    ├── Role: Client
    |      ├── View / Edit Client Profile
    |      |       → ClientProfile model
    |      ├── Create Job Listings
    |      |       → JobListing model + JobListingController
    |      ├── View Applicants, Accept / Reject
    |      ├── View Reviews left by freelancers
    |
    ├── Role: Freelancer
    |      ├── View / Edit Freelancer Profile
    |      ├── Browse Job Listings
    |      ├── Apply to Jobs → JobApplication model
    |      ├── View Reviews left by clients
    |
    └── Role: Admin
           ├── Manage Users (CRUD, reset password)
           ├── Manage Job Listings (CRUD)
           ├── View All Reviews
           ├── Dashboard (stats: user count, job count, review count)
```
