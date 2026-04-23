<?php

enum PostTag: string {
    // Программирование
    case PHP = 'php';
    case JAVASCRIPT = 'javascript';
    case PYTHON = 'python';
    case JAVA = 'java';
    case CPP = 'c++';
    case CSHARP = 'c#';
    case RUBY = 'ruby';
    case GO = 'go';
    case RUST = 'rust';
    
    // Веб-технологии  
    case WEB = 'веб';
    case HTML = 'html';
    case CSS = 'css';
    case REACT = 'react';
    case VUE = 'vue';
    case ANGULAR = 'angular';
    case NODEJS = 'nodejs';
    case WORDPRESS = 'wordpress';
    
    // Базы данных
    case MYSQL = 'mysql';
    case POSTGRESQL = 'postgresql';
    case MONGODB = 'mongodb';
    case REDIS = 'redis';
    case SQL = 'sql';
    
    // Мобильная разработка
    case ANDROID = 'android';
    case IOS = 'ios';
    case FLUTTER = 'flutter';
    case REACTNATIVE = 'react-native';
    
    // Дизайн/UI/UX
    case DESIGN = 'дизайн';
    case UIUX = 'ui-ux';
    case FIGMA = 'figma';
    case PHOTOSHOP = 'photoshop';
    
    // AI/ML
    case AI = 'ai';
    case MACHINELEARNING = 'machine-learning';
    
    // Бизнес/Маркетинг
    case MARKETING = 'маркетинг';
    case SEO = 'seo';
    case STARTUP = 'стартап';
    case BUSINESS = 'бизнес';
    
    // Гаджеты/Техника
    case GADGETS = 'гаджеты';
    case SMARTPHONE = 'смартфон';
    case APPLE = 'apple';
    case SAMSUNG = 'samsung';
    
    // Лайфстайл
    case TRAVEL = 'путешествия';
    case FOOD = 'еда';
    case FITNESS = 'фитнес';
    case BOOKS = 'книги';
    case MOVIES = 'кино';
    case MUSIC = 'музыка';
    
    // Аналитика/Данные
    case DATA = 'данные';
    case ANALYTICS = 'аналитика';
    case EXCEL = 'excel';
    
    // DevOps/Системное
    case DOCKER = 'docker';
    case KUBERNETES = 'kubernetes';
    case LINUX = 'linux';
    case AWS = 'aws';
    
    case OTHER = 'другое';
}