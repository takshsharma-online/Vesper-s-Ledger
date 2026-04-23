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


###Organiser Module (23/04)
- Implemented full mission CRUD (create, view, edit, delete)
- Added agent assignment functionality
- Implemented session handling and role-based access control