CREATE TABLE Admin (
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  password varchar(50) NOT NULL
);

CREATE TABLE Player (
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  description varchar(500),
  createdon DATE
);

CREATE TABLE Sport (
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  description varchar(500),
  sort_order INTEGER, -- 1 tai 0 määrää pitääkö tuloksia katsoa nousevasti vai laskevasti (1=DESC, 0=ASC)
  createdon DATE
);

CREATE TABLE Results (
  id SERIAL PRIMARY KEY,
  player_id INTEGER REFERENCES Player(id),
  sport_id INTEGER REFERENCES Sport(id),
  result varchar(100)
);