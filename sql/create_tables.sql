CREATE TABLE Admin (
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  password varchar(50) NOT NULL
);

CREATE TABLE Players (
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  description varchar(500) NOT NULL,
  createdon DATE
);

CREATE TABLE Sports (
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  description varchar(500) NOT NULL,
  sort_order INTEGER NOT NULL, -- 1 tai 0 määrää pitääkö tuloksia katsoa nousevasti vai laskevasti (1=DESC, 0=ASC)
  createdon DATE
);

CREATE TABLE Results (
  id SERIAL PRIMARY KEY,
  player_id INTEGER REFERENCES Players(id) ON DELETE CASCADE NOT NULL,
  sport_id INTEGER REFERENCES Sports(id) ON DELETE CASCADE NOT NULL,
  result INTEGER NOT NULL,
  createdon DATE
);
