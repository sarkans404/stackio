## StackIO – Q&A Web Platform

StackIO is a full-stack Q&A web application inspired by platforms like StackOverflow. It allows users to ask questions, post responses, interact with content, and receive notifications in a dynamic and modern interface.


## 📷 Preview

##### Home Page

![Home Page](/media/home_page.png)

##### Question Page

![Question Page](/media/question_page.png)

##### Profile Page

![Profile Page](/media/profile_page.png)

##### Create Question

![Create Question](/media/create_question.png)

##### Create Comment

![Create Comment](/media/create_comment.png)

## 🚀 Features

### 👤 Authentication & User System

- User registration & login
- Profile editing (username, avatar, bio)
- Avatar upload with live preview

### ❓ Questions

- Create, edit, and delete questions
- Add multiple images (up to 10 per question)
- Tag system with dynamic input (auto-create + remove)
- View counts, votes, saved and hidden questions

### 💬 Responses & Comments

- Post responses to questions
- Nested comments
- Upload 1 image per response
- Edit and delete responses
- Accept / unaccept answers (only by question owner)

### ⭐ Interactions

- Upvote / downvote system
- Save / unsave questions
- Hide / unhide questions
- Follow questions
- Recently viewed questions tracking
- Search system

### 🔔 Notifications System

Users receive notifications for:

- New response on followed question
- New comment on their response
- Their response being banned by admin
- Their question being reported

### 🏷️ Tags System

- Dynamic tag creation via input
- Attach multiple tags per question
- Popular tags sidebar

### 🎨 UI / UX

- Dark / light mode support
- Responsive layout
- Image gallery with fullscreen mode
- Interactive alerts with progress bar
- Smooth transitions and animations

## 🛠️ Tech Stack

#### Backend

- Laravel (PHP)
- Eloquent ORM
- REST-style controllers

#### Frontend

- Blade templating
- Vanilla JavaScript (modular structure)
- TailwindCSS

#### Database

- MySQL / MariaDB

## 📦 Installation

Clone project:

```
git clone https://github.com/sarkans404/stackio.git
cd stackio
```

Install packages:

```
composer install
npm install
```

Copy `.env` and generate key:

```
cp .env.example .env
php artisan key:generate
```

## ⚙️ Setup

#### Database
```
php artisan migrate
php artisan db:seed
```

#### Storage

```
php artisan storage:link
```

## ▶️ Run Project

```
php artisan serve
npm run dev
```

## 🔐 Environment Variables

Make sure `.env` includes:

```
DB_DATABASE=your_db
DB_USERNAME=your_user
DB_PASSWORD=your_pass
```

## 🧪 Future Improvements

- Pagination improvements (infinite scroll)
- Better responsive for mobile devices
- Enhanced notification system
- Report system
- Reputation system

## 🧾 License

This project is open-source and available under the MIT License.