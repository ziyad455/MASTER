# Real Madrid Match Viewer

A simple web application that fetches and displays Real Madrid's matches by season using the Football-Data.org API.

## Features

- View all matches for Real Madrid by season.
- Automatically highlights:
  - Finished matches with final scores.
  - Upcoming matches with date and opponent info.
- Responsive and styled UI with competition logos and opponent crests.
- Shows venue and referee details for each match.
- Displays score format as `Real Madrid Score - Opponent Score` regardless of home/away status.

## Demo

![Demo Screenshot](screenshot.png)  
*You can add an actual screenshot later.*

## Setup

### 1. Clone the Repository
```bash
git clone [https://github.com/ziyad455/MASTER/tree/main/foot_api].git
cd foot_api
```

### 2. Add Your API Key
Open the JavaScript file and replace the placeholder with your API key:
```javascript
const apiKey = 'YOUR_API_KEY';
```
You can get a free API key by registering at [Football-Data.org](https://www.football-data.org/).

### 3. Open the Application
Simply open `index.html` in a browser.  
No backend is required — it's a fully static frontend app.
