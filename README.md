# Vesper-s-Ledger
Full-stack event and task management system with CRUD operations, user interaction, and structured data handling.

This web application is named after Vesper Lynd from Casino Royale (a James Bond film).
There are three users in this system-->

**1.MI6 Command (The Admin)-->** They are the superusers. They do not participate in the missions but, mamange the agency.
This user ensures the platform remains secure and the field agents are legitimate.
Key functions of this user are-
i)User Management--> can promote an agent to Chief of Station (M) or revoke clearance(delete/suspend users).
ii)System Integrity--> can view all active/deleted missions across the entire agency.
iii)Audit Logs--> they need to see who is doing what? If a mission data is deleted the admin needs to know why.

**2.Chief of Station, M (The Organiser)-->** they have high level access with a focus on mission logistics. They are responsible 
for the success or failure of their specific mission.
Key functions of this user are-
i)Defining the Mission--> they define the title of the mission. They are also responsible for intel briefing and setting up the location of the mission.
ii)Agent Management--> they see which agents have signed up for their missions and can assign/remove them.
iii)The Burn Notice--> if a mission gets compromised, they are the ones who delete/abort it.
iv)Sending Backup and Gadgets--> they are responsible for sending backup to field agents on request. The gadgets are dispatched by Q Branch.

**3.The Filed Agent (The Attendee)-->** this is the end user(the Spy).
Key functions of this user are-
i)Acceptance--> they browse missions and commit to one.
ii)Dossier Access--> they have access personalised dashboard where they only see the missions they are currently assigned to.
iii)Profile Management--> they can provide updates to the Chief of Station about the mission. 
iv)Requesting Backup and Gadgets--> they can request backup from Chief of Station.The gadgets are dispatched by Q Branch.

**The Q-Branch**
This is not a user, it is an automated Inventory System.
The agents can request a gadgets from a pre-defined list. The Chief of Station is responsible for approved or denying of these requests.


** Organiser Module (23/04)
- Implemented full mission CRUD (create, view, edit, delete)
- Added agent assignment functionality
- Implemented session handling and role-based access control

** Authentication Module (26/04)
- Implemented secure login system with database validation
- Stored user session data for access control across modules
- Added role-based access and redirection for Admin, Organiser, and Agent users
- Added create_organiser, organiser setup script
- Added logout.php to handle session termination and redirect to login

** Added missions (01/05) 
- Added navigation option to delete missions from organiser dashboard
- Extended the mission creation form to include additional fields
- Added objective, intel description, and creation date
- Updated database insertion to store full mission details
- Improved validation to ensure all fields are completed

**Authentication Guard for Agents**
1. agent_auth.php inside /attendee
2. Purpose--> to act as a bouncer for MI6 by establishing a reusable lock. 
3. This file will be used on top of each page that the **field agent** needs to access.


**Login Page**
1.Every user to this system will have to go through login.php. It acts as a sigle front door to your entire MI6 system.
2.When a user submits their email and password, the PHP code queries the users table. 
If the password is correct, it looks at the role_id column for that specific user.
3.Based on that role_id, your login.php script acts like a traffic cop and redirects them to their correct, restricted folder:
•	If role_id == 3 (Field Agent): The script redirects them to attendee/dashboard.php.
•	If role_id == 2 (Chief of Station / Organiser): You will add an elseif statement to redirect them to organiser/dashboard.php.
•	If role_id == 1 (Admin): You will add another elseif statement to redirect them to admin/dashboard.php.
