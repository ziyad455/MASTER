const apiKey = '1815c132ab794689a8fcd2eefc2c95fb';
const teamId = 86;

let currentSeason = 2024;

const seasonSelect = document.getElementById('season-select');
const matchesContainer = document.getElementById('matches-container');
const loadingElement = document.getElementById('loading');
const errorElement = document.getElementById('error');

document.addEventListener('DOMContentLoaded', () => {
  fetchMatches(currentSeason);
});

seasonSelect.addEventListener('change', (e) => {
  currentSeason = parseInt(e.target.value);
  fetchMatches(currentSeason);
});

function fetchMatches(season) {
  loadingElement.style.display = 'block';
  errorElement.style.display = 'none';
  matchesContainer.innerHTML = '';

  const url = `https://api.football-data.org/v4/teams/${teamId}/matches?season=${season}`;

  fetch(url, {
    method: 'GET',
    headers: {
      'X-Auth-Token': apiKey
    }
  })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      loadingElement.style.display = 'none';
      displayMatches(data.matches);
    })
    .catch(error => {
      loadingElement.style.display = 'none';
      errorElement.style.display = 'block';
      errorElement.textContent = `Error loading matches: ${error.message}`;
      console.error('There was an error with the fetch operation:', error);
    });
}

function displayMatches(matches) {
  if (!matches || matches.length === 0) {
    matchesContainer.innerHTML = '<div class="no-matches">No matches found for this season.</div>';
    return;
  }

  matches.sort((a, b) => new Date(b.utcDate) - new Date(a.utcDate));

  matches.forEach(match => {
    const matchElement = document.createElement('div');
    matchElement.classList.add('match');

    const isHome = match.homeTeam.id === teamId;
    const opponent = isHome ? match.awayTeam : match.homeTeam;
    const opponentName = opponent.shortName || opponent.name;
    const opponentLogo = opponent.crest || 'https://via.placeholder.com/60x60?text=Team';

    const homeScore = match.score.fullTime.home !== null ? match.score.fullTime.home : '-';
    const awayScore = match.score.fullTime.away !== null ? match.score.fullTime.away : '-';
    const isFinished = match.status === 'FINISHED';

    const matchDate = new Date(match.utcDate);
    const options = {
      weekday: 'long',
      year: 'numeric',
      month: 'long',
      day: 'numeric',
      hour: '2-digit',
      minute: '2-digit'
    };
    const formattedDate = matchDate.toLocaleDateString('en-US', options);

    const competitionName = match.competition?.name || 'Unknown Competition';
    const competitionLogo = match.competition?.emblem || 'https://via.placeholder.com/30x30?text=Comp';

    let statusClass = 'status-scheduled';
    if (match.status === 'FINISHED') {
      statusClass = 'status-finished';
    } else if (match.status === 'IN_PLAY' || match.status === 'PAUSED') {
      statusClass = 'status-inplay';
    }

    matchElement.innerHTML = `
      <div class="match-header">Matchday ${match.matchday || 'N/A'}</div>
      <div class="match-content">
        <div class="competition-info">
          <img src="${competitionLogo}" alt="${competitionName}" class="competition-logo">
          <span class="competition-name">${competitionName}</span>
        </div>

        <div class="teams-container">
          <div class="team ${isHome && isFinished && homeScore > awayScore ? 'winner' : ''}">
            <img src="https://crests.football-data.org/86.png" alt="Real Madrid" class="team-logo">
            <span class="team-name">Real Madrid</span>
          </div>

          <div class="score-container">
            <span class="vs">${isFinished ? 'Final Score' : 'Upcoming Match'}</span>
            ${isFinished ? 
              `<span class="final-score">${
                      isHome ? `${homeScore} - ${awayScore}` : `${awayScore} - ${homeScore}`
                    }</span>
` : 
              `<span class="score">VS</span>`
            }
            <span class="match-time">${formattedDate}</span>
          </div>

          <div class="team ${!isHome && isFinished && awayScore > homeScore ? 'winner' : ''}">
            <img src="${opponentLogo}" alt="${opponentName}" class="team-logo">
            <span class="team-name">${opponentName}</span>
          </div>
        </div>

        <div class="match-details">
          <div class="detail-row">
            <span class="detail-label">Venue:</span>
            <span class="detail-value">${isHome ? 'Santiago Bernabéu' : match.venue || 'Away'}</span>
          </div>
          <div class="detail-row">
            <span class="detail-label">Referee:</span>
            <span class="detail-value">${match.referees?.[0]?.name || 'TBD'}</span>
          </div>
        </div>
      </div>

      <div class="match-status ${statusClass}">${match.status.replace('_', ' ')}</div>
    `;

    matchesContainer.appendChild(matchElement);
  });
}
